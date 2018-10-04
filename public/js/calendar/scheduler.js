/* eslint-disable */

// Defines a Vue component that wraps Bryntum Scheduler
Vue.component('scheduler', {

    props : {
        // Configs
        autoHeight : {
            default : true,
            type    : Boolean
        },
        columns    : Array,
        readOnly   : Boolean,
        rowHeight  : Number,
        events     : Array,
        resources  : Array,
        startDate  : Date,
        endDate    : Date,
        viewPreset : {
            default : 'dayAndWeek',
            type    : String
        },
        forceFit   : {
            default : true,
            type    : Boolean
        },
        barMargin  : {
            default : 2,
            type    : Number
        },

        config : Object,

        // Features, only used for initialization
        columnLines       : { type : [Boolean, Object], default : true },
        dependencies      : [Boolean, Object],
        eventDrag         : { type : [Boolean, Object], default : true },
        eventContextMenu  : [Boolean, Object],
        eventDragCreate   : { type : [Boolean, Object], default : true },
        cellEdit          : { type : [Boolean, Object], default : true },
        eventEdit         : {
            default : true,
            type    : [Boolean, Object]
        },
        eventFilter       : { type : [Boolean, Object], default : true },
        eventResize       : { type : [Boolean, Object], default : true },
        eventTooltip      : { type : [Boolean, Object], default : true },
        groupSummary      : [Boolean, Object],
        headerContextMenu : [Boolean, Object],
        labels            : [Boolean, Object],
        nonWorkingTime    : Boolean,
        scheduleTooltip   : {
            default : true,
            type    : [Boolean, Object]
        },
        summaryToolbar    : [Boolean, Object],
        group             : [Boolean, Object, String],
        sort              : [Boolean, String, Array],
        regionResize      : Boolean,
        stripe            : Boolean,
        timeRanges        : {
            default : true,
            type    : [Boolean, Array]
        }

    },

    data : function() {
        return {
            schedulerFeatures : [
                'columnLines', 'dependencies', 'eventDrag', 'eventContextMenu', 'eventDrag', 'eventDragCreate', 'eventEdit', 'eventFilter',
                'eventResize', 'eventTooltip', 'groupSummary', 'headerContextMenu', 'nonWorkingTime', 'scheduleTooltip',
                'summary', 'timeRanges', 'cellEdit', 'group'
            ]
        }
    },

    template : '<div id="container"></div>',

    mounted : function() {
        this.render()
    },

    beforeDestroy : function() {
        // Make sure Bryntum Grid is destroyed when vue component is
        this.schedulerEngine.destroy();
    },

    watch : {

        barMargin : function(newValue) {
            this.schedulerEngine.barMargin = newValue;
        },

        events : function(newValue) {
            this.schedulerEngine.events = newValue.slice();
        },

        resources : function(newValue) {
            this.schedulerEngine.resources = newValue.slice();
        },

        timeRanges : function(newValue) {
            this.schedulerEngine.timeRanges = newValue.slice();
        }
    },

    methods : {
        render : function() {
            var propKeys      = Object.keys(this.$props),
                featureConfig = {};

            var config = {
                // Render grid to components element
                appendTo : this.$el,

                // Listeners, will relay events using $emit
                listeners : {
                    catchAll : function(event) {
                        this.$emit(event.type, event);
                    },

                    thisObj : this
                },

                features : featureConfig
            };

            // Apply all props to grid config
            propKeys.forEach(function(prop) {
                if (this.schedulerFeatures.indexOf(prop) > -1) {
                    // Prop is a feature config
                    featureConfig[prop] = this[prop];
                }
                else if (prop === 'config') {
                    // Prop is a config object
                    Object.assign(config, this[prop]);
                }
                else {
                    // Prop is a config
                    config[prop] = this[prop];
                }
            }, this);

            // Create a Bryntum Grid with props as configs
            this.schedulerEngine = new bryntum.scheduler.Scheduler(config);
        },
        removeEvent : function() {
            var scheduler = this.schedulerEngine;

            scheduler.eventStore.remove(scheduler.selectedEvents[0]);
            if(scheduler.selectedEvents[0]){

                if(typeof scheduler.selectedEvents[0].data.id == "number"){
                    axios.post('/delete/'+scheduler.selectedEvents[0].data.id)
                        .then(res => {

                            },
                            err => {
                                console.log(err)
                            }

                        )
                }
            }

            scheduler.eventStore.refresh;


        },
        removeFromStore: function(event){
            var scheduler = this.schedulerEngine;
            scheduler.eventStore.remove(event);

        },
        addSaveEvent: function(data) {

        },

        editRangeDate: function(start,end){this.$props.startDate = new Date(start);
            this.$props.endDate = new Date(end);
            if(!this.schedulerEngine.isDestroyed){

                this.schedulerEngine.destroy()
                this.render()
            }
            else {
                this.render()

            }
        },

        addEvent : function(data) {
            var scheduler = this.schedulerEngine,
                startDate = new Date(scheduler.startDate.getTime()),
                endDate   = new Date(startDate.getTime());
            endDate.setHours(endDate.getHours() + 48);
            // scheduler.openPopup()
            if(data){
                data = data.data
                scheduler.eventStore.add({
                    endDate: data.endDate,
                    eventColor: data.eventColor,
                    eventType: data.eventType,
                    id: data.id,
                    name: data.name,
                    resourceId: data.resourceId,
                    startDate: data.startDate,
                })

            }
            else {

                scheduler.eventStore.add({
                    resourceId : scheduler.resources[1].id,
                    startDate  : startDate,
                    endDate    : endDate,
                    name       : 'New task',
                    eventType  : 'Meeting',
                })
            }

            scheduler.eventStore.refresh;


        }
    }
});
