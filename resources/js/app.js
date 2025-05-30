import './bootstrap';

// choices.js
import Choices from 'choices.js';
window.Choices = Choices;
import 'choices.js/public/assets/styles/choices.min.css';

import './trix';

// Flatpickr
import flatpickr from 'flatpickr';
window.flatpickr = flatpickr;
import { Danish } from 'flatpickr/dist/l10n/da.js';
// if(Sequii.locale == 'da') {
//     flatpickr.localize(Danish);
// }
import 'flatpickr/dist/flatpickr.min.css';

// FilePond
import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

FilePond.registerPlugin(FilePondPluginFileValidateType);

window.FilePond = FilePond;
import 'filepond/dist/filepond.min.css';

// MDTimePicker
import '@dmuy/timepicker/dist/mdtimepicker.css';
import mdtimepicker from '@dmuy/timepicker';
window.mdtimepicker = mdtimepicker;

import ui from '@alpinejs/ui';
import focus from '@alpinejs/focus';
Alpine.plugin(ui);
Alpine.plugin(focus);

Alpine.data('signature_editor', (path, url, boxes) => ({
    pdf_path: path,
    url: url,
    open: false,
    background: null,
    page_number: 1,
    total_pages: 0,
    viewport: null,
    stage: null,
    layer: null,
    loading: true,
    boxes: boxes,
    init() {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://unpkg.com/pdfjs-dist@3/build/pdf.worker.js';
        this.$watch('open', value => {
            if(value) {
                this.initDrawer();
            } else {
                this.destroyDrawer();
            }
        })
    },
    initDrawer() {
        pdfjsLib.getDocument(this.pdf_path).promise.then((pdf) => {
            this.total_pages = pdf.numPages;
            // Cannot save on data
            window.loaded_pdf = pdf;
            this.getPageBackground();
        });
    },
    destroyDrawer() {
        this.stage.destroy();
        this.layer.destroy();
        this.stage = null;
        this.layer = null;
        this.loading = true;
    },
    getPageBackground() {
        loaded_pdf.getPage(this.page_number).then((page) => {
            let scale = .8;
            this.viewport = page.getViewport({scale: scale});

            var canvas = document.getElementById('pdf-canvas');
            var context = canvas.getContext('2d');
            canvas.height = this.viewport.height;
            canvas.width = this.viewport.width;
            var renderContext = {
                canvasContext: context,
                viewport: this.viewport
            };
            var renderTask = page.render(renderContext);
            renderTask.promise.then(() => {
                if(!this.stage) {
                    this.renderDrawer();
                }
                this.background = canvas.toDataURL();
                this.addBackground();

                if(this.boxes) {
                    this.boxes.forEach((item) => {
                        if(item.page_number == this.page_number) {
                            this.addBox(item.name.split('-')[0], item.name.split('-')[1], item.x, item.y, item.height, item.width);
                        }
                    });
                }
            });
        });
    },
    addBackground() {
        var imageObj = new Image();
        imageObj.onload = () => {
            var yoda = new Konva.Image({
                x: 0,
                y: 0,
                image: imageObj,
                width: this.stage.width(),
                height: this.stage.height(),
            });

            this.layer.add(yoda);
            this.layer.draw();
        };
        imageObj.src = this.background;
    },
    renderDrawer() {
        this.stage = new Konva.Stage({
            container: 'signature-editor',
            width: this.viewport.width,
            height: this.viewport.height
        });
        this.loading = false;

        this.layer = new Konva.Layer();
        this.stage.add(this.layer);
    },
    addSignatureBoxes(cobinations) {
        console.log(this.stage.width())
        console.log(this.stage.height())
        console.log(cobinations)
        if(cobinations === 3) {
            this.addBox('date', cobinations, 70, 550, 93, 39);
            this.addBox('signature', cobinations, 112, 550, 93, 65);
            this.addBox('title', cobinations, 182, 550, 93, 80);
        }
        if(cobinations === 6) {
            this.addBox('date', cobinations, 267, 550, 93, 39);
            this.addBox('signature', cobinations, 309, 550, 93, 65);
            this.addBox('title', cobinations, 376, 550, 93, 80);
        }
    },
    addBox(type, combinations, x, y, height, width) {
        Konva.Image.fromURL(`${this.url}/images/${type}-${combinations}.png`, (image) => {
            image.setAttrs({
                x: x,
                y: y,
                width: width,
                height: height,
                draggable: true,
                opacity: 0.8,
                name: `${type}-${combinations}`
            });
            this.layer.add(image);
            this.layer.draw();

            const transformer = new Konva.Transformer({
                anchorSize: 10,
                rotateEnabled: false,
                borderStroke: '#4a90e2',
                borderDash: [3, 3],
                keepRatio: false,
                enabledAnchors: ['top-left', 'top-right', 'bottom-left', 'bottom-right'],
            });

            this.layer.add(transformer);
            transformer.attachTo(image);
        });
    },
    clearBoxes() {
        this.layer.destroyChildren();
        this.layer.draw();
        this.addBackground();
    },
    updateBoxes() {

        this.boxes = this.boxes = this.boxes.filter((item) => {
            return item.page_number != this.page_number;
        });

        let boxes = this.layer.children.filter((item) => {
            return item.attrs.name && item.attrs.name.match(/date|title|signature/);
        }).map((item) => {
            return {
                name: item.attrs.name,
                x: item.attrs.x,
                y: item.attrs.y,
                width: item.attrs.scaleX ? item.attrs.width * item.attrs.scaleX : item.attrs.width,
                height: item.attrs.scaleY ? item.attrs.height * item.attrs.scaleY : item.attrs.height,
                canvas_width:  this.stage.width(),
                canvas_height: this.stage.height(),
                page_number: this.page_number,
            }
        });

        this.boxes = this.boxes.concat(boxes);
    },
    save(close) {
        this.updateBoxes();
        this.$wire.form.data.signature_boxes = this.boxes;
        this.open = false;
    },
    nextPage() {
        if(this.page_number < this.total_pages) {
            this.updateBoxes();
            this.page_number++;
            this.destroyDrawer();
            this.getPageBackground();
        }
    },
    prevPage() {
        if(this.page_number > 1) {
            this.updateBoxes();
            this.page_number--;
            this.destroyDrawer();
            this.getPageBackground();
        }
    }
}));

import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
document.addEventListener('alpine:init', () => {
    // Magic: $tooltip
    Alpine.magic('tooltip', el => message => {
        let instance = tippy(el, { content: message, trigger: 'manual' })

        instance.show()

        setTimeout(() => {
            instance.hide()

            setTimeout(() => instance.destroy(), 150)
        }, 2000)
    })

    // Directive: x-tooltip
    Alpine.directive('tooltip', (el, { expression }) => {
        tippy(el, { content: expression })
    })
})
