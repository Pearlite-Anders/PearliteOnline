// Chart.js
import Chart from 'chart.js/auto';

// Chart on RoutineInspection
Alpine.data('routine_inspection_wps_chart', (labels, values) => ({
    labels: labels,
    values: values,
    init() {
        let chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: this.labels,
                datasets: [{
                    data: this.values,
                    backgroundColor: ['#15803d', '#94a3b8'],
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                },
            },
        })

        this.$watch('values', () => {
            chart.data.labels = this.labels
            chart.data.datasets[0].data = this.values
            chart.update()
        })
    }
}));
