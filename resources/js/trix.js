// Trix
import Trix from "trix"



addEventListener("trix-initialize", function(event) {
    var buttonHTML = '<button type="button" class="trix-button" data-trix-action="drawio"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"><path fill="currentColor" d="M2 5.25A3.25 3.25 0 0 1 5.25 2h10.5A3.25 3.25 0 0 1 19 5.25v6.033A2.749 2.749 0 0 0 17.785 11H17.5V5.25a1.75 1.75 0 0 0-1.75-1.75H5.25A1.75 1.75 0 0 0 3.5 5.25v11.5c0 .966.784 1.75 1.75 1.75h3.37L7.357 20H5.25A3.25 3.25 0 0 1 2 16.75V5.25ZM6.75 6a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5h-7.5Zm.32 6.434A.75.75 0 0 1 7.75 12h10.035a1.75 1.75 0 0 1 1.338.623l3.7 4.394a.75.75 0 0 1 0 .966l-3.7 4.394a1.75 1.75 0 0 1-1.338.623H7.75a.75.75 0 0 1-.574-1.233L10.77 17.5l-3.594-4.267a.75.75 0 0 1-.106-.8ZM9.362 13.5l2.962 3.517a.75.75 0 0 1 0 .966L9.362 21.5h8.423a.25.25 0 0 0 .191-.089L21.27 17.5l-3.294-3.911a.25.25 0 0 0-.191-.089H9.362ZM6.75 9a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Z"/></svg></button>';
    event.target.toolbarElement.querySelector(".trix-button-group--file-tools").insertAdjacentHTML("beforeend", buttonHTML)

    const editor = event.target
    window.testEditor = editor;
    let iframe;
    let DRAW_IFRAME_URL = 'https://embed.diagrams.net/?embed=1&ui=min&spin=1&proto=json&configure=1';
    let border = 0;
    let element;

    var resize = function() {
        iframe.setAttribute('width', window.innerWidth - 2 * border);
        iframe.setAttribute('height', window.innerHeight - 2 * border);
    };

    var close = function() {
        window.removeEventListener('resize', resize);
        window.removeEventListener('message', receive);
        document.body.removeChild(iframe);
        document.body.style.overflow = '';
        element = null;
    }

    var receive = function(event) {
        if(event.data.length) {
            let msg = JSON.parse(event.data);
            if (msg.event == 'configure') {
                iframe.contentWindow.postMessage(JSON.stringify({
                    action: 'configure',
                    config: { defaultFonts: ["Humor Sans", "Helvetica", "Times New Roman"] }
                }), '*');
            } else if (msg.event == 'init') {
                console.log(element);
                if (element != null) {
                    let xml = element.querySelector('img').getAttribute('src').split(',')[1];
                    console.log(xml)
                    xml = decodeURIComponent(escape(atob(xml)));
                    iframe.contentWindow.postMessage(JSON.stringify({
                        action: 'load',
                        autosave: 1, xml: xml
                    }), '*');

                    iframe.contentWindow.postMessage(JSON.stringify({
                        action: 'status',
                        modified: true
                    }), '*');
                }
                else {
                    iframe.contentWindow.postMessage(JSON.stringify({
                        action: 'load',
                        autosave: 1, xml: null
                    }), '*');
                }
            } else if (msg.event == 'save') {
                iframe.contentWindow.postMessage(JSON.stringify({
                    action: 'export',
                    format: 'xmlsvg', xml: msg.xml, spin: 'Updating page'
                }), '*');

            } else if (msg.event == 'export') {
                // Extracts SVG DOM from data URI to enable links
                var svg = atob(msg.data.substring(msg.data.indexOf(',') + 1));
                close();
                var attachment = new Trix.Attachment(
                    { content: `<span data-type="drawio-element"><img src="data:image/svg+xml;base64,${btoa(svg)}" /></span>` }
                )
                editor.editor.insertAttachment(attachment);
            } else if (msg.event == 'exit') {
                close();
            }

        // if (event.data == 'ready') {
        //     iframe.contentWindow.postMessage(xml, '*');
        //     resize();
        // }
    }

    };

    const drawio = {
        test: function() {
            return true;
        },
        perform() {
			document.body.style.overflow = 'hidden';
			iframe = document.createElement('iframe');
			iframe.style.zIndex = '9999';
			iframe.style.position = 'absolute';
			iframe.style.top = border + 'px';
			iframe.style.left = border + 'px';
            iframe.style.backgroundColor = 'white';
            iframe.setAttribute('frameborder', '0');
			window.addEventListener('resize', resize);
			resize();
			window.addEventListener('message', receive);
			iframe.setAttribute('src', DRAW_IFRAME_URL);
			document.body.appendChild(iframe);
        }
    }
    Object.assign(editor.editorController.actions, { drawio })

    window.addEventListener("edit-drawio-element", function(event) {
        element = event.detail.trixElement;
        console.log(event.detail);
        document.body.style.overflow = 'hidden';
        iframe = document.createElement('iframe');
        iframe.style.zIndex = '9999';
        iframe.style.position = 'absolute';
        iframe.style.top = border + 'px';
        iframe.style.left = border + 'px';
        iframe.style.backgroundColor = 'white';
        iframe.setAttribute('frameborder', '0');
        window.addEventListener('resize', resize);
        resize();
        window.addEventListener('message', receive);
        iframe.setAttribute('src', DRAW_IFRAME_URL);
        document.body.appendChild(iframe);

    })
})
