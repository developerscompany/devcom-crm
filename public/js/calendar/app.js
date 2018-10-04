/* eslint-disable */

var vm = new Vue({
    el : '#app',

    data : {
        features : {
            group : 'project',
        },
        events      : [],
        resources   : [],
        timeRanges  : true,
        barMargin   : 15,
        sDate: "",
        eDate: "",
        startDate  : new Date(new Date().getFullYear(), new Date().getMonth(), 1, 0),
        endDate    : new Date(new Date().getFullYear(), new Date().getMonth(), 31, 23),
        selectedEvent : '',
        columns : [
            {
                //imagePath : '../_shared/images/users/',
                text     : 'Client',
                field   : 'client',
                width    : 130
            },
            {
                //imagePath : '../_shared/images/users/',
                text     : 'Person',
                field   : 'person',
                width    : 130
            },
            /*{
                text   : 'Type',
                field  : 'role',
                width  : 110,
                editor : {
                    type        : 'combo',
                    items       : ['Sales', 'Developer', 'Marketing', 'Product manager'],
                    editable    : false,
                    pickerWidth : 140
                }
            }*/
        ]
    },

    methods : {


        addEvent : function () {
            this.$refs.scheduler.addEvent();
        },
        editDate : function () {

            this.$refs.scheduler.editRangeDate(pickerS.dateSelected,pickerE.dateSelected)//setTimeSpan(this.startDate,this.endDate)
        },

        removeEvent : function () {
            this.$refs.scheduler.removeEvent();
            this.selectedEvent = '';
        },
        onDestroyEvent: function (event){
            if (event.eventRecord) {
                this.selectedEvent = event.eventRecord.data.name;
                this.$refs.scheduler.selectedEvent = event.eventRecord;
                this.$refs.scheduler.removeEvent();
            }

            this.selectedEvent = '';


        },

        onEventSelectionChange : function (selection) {
            if(selection.selected[0].data.length > 0){
                if (typeof selection.selected[0].data.id == 'number') {

                    let one = selection.selected[0].data
                    this.selectedEvent = selection.selected[0].data;

                }
                else {
                    this.selectedEvent = '';
                }
            }

        },
        onEventAdd : function (event ) {

            let data = {}
            data.person_id = event.resources[0].data.id.split('_')[0]
            data.task_id = event.resources[0].data.id.split('_')[1]
            data.start = event.eventRecord.data.startDate.getFullYear()+"-"+(event.eventRecord.data.startDate.getMonth()+1)+"-"+event.eventRecord.data.startDate.getDate()
            data.end = event.eventRecord.data.endDate.getFullYear()+"-"+(event.eventRecord.data.endDate.getMonth()+1)+"-"+event.eventRecord.data.endDate.getDate()
            data.hours = event.eventRecord.data.name
            data.dow_start = event.eventRecord.data.startDate.getDay()
            data.dow_end = event.eventRecord.data.endDate.getDay()
            if(!event.eventRecord.data.saved){
                axios.post('/create',  {data})
                    .then(res => {

                            if (event.eventRecord) {
                                this.selectedEvent = event.eventRecord.data.name;
                                this.$refs.scheduler.removeFromStore(event.eventRecord);
                            }

                            this.$refs.scheduler.addEvent(res.data)

                        },
                        err => {
                            console.log(err)
                        }

                    )

            }
            event.eventRecord.data.saved = true;

        },
        onEventEdit : function (event ) {


            if(typeof event.eventRecord.data.id == 'number'){
                let data = {}
                data.person_id = event.eventRecord.data.resourceId.split('_')[0]
                data.task_id = event.eventRecord.data.resourceId.split('_')[1]
                data.start = event.eventRecord.data.startDate.getFullYear()+"-"+(event.eventRecord.data.startDate.getMonth()+1)+"-"+event.eventRecord.data.startDate.getDate()
                data.end = event.eventRecord.data.endDate.getFullYear()+"-"+(event.eventRecord.data.endDate.getMonth()+1)+"-"+event.eventRecord.data.endDate.getDate()
                data.hours = event.eventRecord.data.name
                data.dow_start = event.eventRecord.data.startDate.getDay()
                data.dow_end = event.eventRecord.data.endDate.getDay()

                console.log(data)
                axios.post('/edit/'+event.eventRecord.data.id,  {data})
                    .then(res => {
                            console.log(res.data)

                            if (event.eventRecord) {
                                this.selectedEvent = event.eventRecord.data.name;
                                this.$refs.scheduler.removeFromStore(event.eventRecord);
                            }

                            this.$refs.scheduler.addEvent(res.data)

                        },
                        err => {
                            console.log(err)
                        }

                    )
            }
            else {
                let data = {}
                data.person_id = event.eventRecord.data.resourceId.split('_')[0]
                data.task_id = event.eventRecord.data.resourceId.split('_')[1]
                data.start = event.eventRecord.data.startDate.getFullYear()+"-"+(event.eventRecord.data.startDate.getMonth()+1)+"-"+event.eventRecord.data.startDate.getDate()
                data.end = event.eventRecord.data.endDate.getFullYear()+"-"+(event.eventRecord.data.endDate.getMonth()+1)+"-"+event.eventRecord.data.endDate.getDate()
                data.hours = event.eventRecord.data.name
                data.dow_start = event.eventRecord.data.startDate.getDay()
                data.dow_end = event.eventRecord.data.endDate.getDay()
                if(!event.eventRecord.data.saved){

                axios.post('/create',  {data})
                    .then(res => {

                            if (event.eventRecord) {
                                this.selectedEvent = event.eventRecord.data.name;
                                this.$refs.scheduler.removeFromStore(event.eventRecord);
                            }

                            this.$refs.scheduler.addEvent(res.data)

                        },
                        err => {
                            console.log(err)
                        }

                    )
                }
                event.eventRecord.data.saved = true;

            }

        }
    },

    created: function () {
    }

});
