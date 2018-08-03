var app = new Vue({

    el: '#root',

    data: {

        sdate: [],

        date: null,
        dateFormatted: '',
        menu2: false,

        agents: [],
        sources: [],
        statuss: [],
        lines: [],
        ssource: [],
        sagent: [],
        sstatus: [],
        stech: [],

        number: 5,
        pageNumber: 0,

        nums: [5,10,15,20,50,100]
    },

    mounted() {

        axios.get('/admin/lines')
            .then(response => this.lines = response.data);

        axios.get('/admin/agents')
            .then(response => this.agents = response.data);

        axios.get('/admin/sources')
            .then(response => this.sources = response.data);

        axios.get('/admin/statuss')
            .then(response => this.statuss = response.data);


    },

    watch: {

        date (val) {
            this.dateFormatted = this.formatDate(this.date)
        }
    },

    computed: {

        pageCount(){
            let l = this.lines.length,
                s = this.number;
            return Math.floor(l/s);
        },
        paginatedData(){
            var self = this;

            const start = self.pageNumber * self.number,
                end = start + self.number;


            if (self.dateFormatted == null) {
                self.dateFormatted = '';
            }
            if (self.dateFormatted.length > 0) {

                return self.lines.filter(function(item) {
                    return self.dateFormatted.indexOf(item[0]) > -1;
                }).slice(start, end);

            }
            if (self.ssource.length > 0) {

                return self.lines.filter(function(item) {
                    return self.ssource.indexOf(item[2]) > -1;
                }).slice(start, end);

            }
            if (self.sagent.length > 0) {

                return self.lines.filter(function(item) {
                    return self.sagent.indexOf(item[1]) > -1;
                }).slice(start, end);

            }
            if (self.stech.length > 0) {

                return self.lines.filter(function (item) {
                    return Object.keys(item).some(function (key) {
                        return String(item[4]).toLowerCase().indexOf(self.stech) > -1
                    });
                }).slice(start, end);
            }
            if (self.sstatus.length > 0) {

                return self.lines.filter(function(item) {
                    return self.sstatus.indexOf(item[10]) > -1;
                }).slice(start, end);

            }

            return this.lines.slice(start, end);
        }
    },

    methods: {

        formatDate (date) {
            if (!date) return null;

            const [year, month, day] = date.split('-');
            return `${day}.${month}.${year}`
        },

        changeNum(index) {
            this.number = index;
        },
        nextPage()  {
            this.pageNumber++;
        },
        prevPage(){
            this.pageNumber--;
        }

    },

});