@extends('user.layouts.app')

@section('content')

    <div id="app-vue" class="wrapper p-3">
        <bids
                :lines="{{json_encode($lines)}}"
                {{--:roles="{{json_encode($agents)}}"--}}
                :sources="{{json_encode($sourses)}}"
                :statuss="{{json_encode($statuses)}}"
                :timing="{{json_encode($timings)}}"
        ></bids>
    </div>

@endsection

@section('script')

    {{--<script src="//unpkg.com/element-ui"></script>--}}
    {{--<script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>--}}

    {{--<script>--}}

        {{--ELEMENT.locale(ELEMENT.lang.en);--}}

        {{--var app = new Vue({--}}

            {{--el: '#root',--}}

            {{--data: {--}}

                {{--dialog: false,--}}
                {{--editedIndex: -1,--}}
                {{--editedItem: {--}}
                    {{--10: '',--}}
                {{--},--}}
                {{--defaultItem: {--}}
                    {{--10: '',--}}
                {{--},--}}

                {{--value6: '',--}}

                {{--sdate: [],--}}

                {{--date: null,--}}
                {{--dateFormatted: '',--}}
                {{--menu2: false,--}}

                {{--agents: [],--}}
                {{--sources: [],--}}
                {{--statuss: [],--}}
                {{--lines: [],--}}
                {{--ssource: [],--}}
                {{--sagent: [],--}}
                {{--sstatus: [],--}}
                {{--stech: [],--}}

                {{--number: 15,--}}
                {{--pageNumber: 0,--}}

                {{--active: false,--}}
                {{--show: false,--}}

                {{--nums: [5,10,15,20,50,100],--}}

            {{--},--}}

            {{--mounted() {--}}

                {{--axios.get('/user/lines')--}}
                    {{--.then(response => this.lines = response.data);--}}

                {{--axios.get('/user/agents')--}}
                    {{--.then(response => this.agents = response.data);--}}

                {{--axios.get('/user/sources')--}}
                    {{--.then(response => this.sources = response.data);--}}

                {{--axios.get('/user/statuss')--}}
                    {{--.then(response => this.statuss = response.data);--}}


                {{--$('#line-form').submit(function (event) {--}}
                    {{--event.preventDefault();--}}

                    {{--let data = $(this).serialize();--}}
                    {{--$('#line-form')[0].reset();--}}

                    {{--axios.post('/user/add-google-line', data)--}}
                        {{--.then(response => {--}}
                            {{--app.newLine = response.data;--}}
                            {{--app.lines.unshift(app.newLine)--}}
                        {{--});--}}
                {{--});--}}

            {{--},--}}

            {{--watch: {--}}

                {{--date (val) {--}}
                    {{--this.dateFormatted = this.formatDate(this.date)--}}
                {{--},--}}

                {{--dialog (val) {--}}
                    {{--val || this.close()--}}
                {{--},--}}

                {{--dat(val) {--}}

                {{--}--}}

            {{--},--}}

            {{--computed: {--}}

                {{--pageCount(){--}}
                    {{--let l = this.lines.length,--}}
                        {{--s = this.number;--}}
                    {{--return Math.floor(l/s);--}}
                {{--},--}}
                {{--paginatedData(){--}}
                    {{--var self = this;--}}

                    {{--const start = self.pageNumber * self.number,--}}
                        {{--end = start + self.number;--}}


                    {{--if (self.dateFormatted == null) {--}}
                        {{--self.dateFormatted = '';--}}
                    {{--}--}}
                    {{--if (self.dateFormatted.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.dateFormatted.indexOf(item[0]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}
                    {{--if (self.ssource.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.ssource.indexOf(item[2]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}
                    {{--if (self.sagent.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.sagent.indexOf(item[1]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}
                    {{--if (self.stech.length > 0) {--}}

                        {{--return self.lines.filter(function (item) {--}}
                            {{--return Object.keys(item).some(function (key) {--}}
                                {{--return String(item[4]).toLowerCase().indexOf(self.stech) > -1--}}
                            {{--});--}}
                        {{--}).slice(start, end);--}}
                    {{--}--}}
                    {{--if (self.sstatus.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.sstatus.indexOf(item[10]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}

                    {{--return this.lines.slice(start, end);--}}
                {{--}--}}
            {{--},--}}

            {{--methods: {--}}

                {{--editItem (item) {--}}
                    {{--this.editedIndex = this.lines.indexOf(item);--}}
                    {{--this.editedItem = Object.assign({}, item);--}}
                    {{--this.dialog = true;--}}
                {{--},--}}
                {{--close () {--}}
                    {{--this.dialog = false;--}}
                    {{--setTimeout(() => {--}}
                        {{--this.editedItem = Object.assign({}, this.defaultItem);--}}
                        {{--this.editedIndex = -1;--}}
                    {{--}, 300)--}}
                {{--},--}}
                {{--save () {--}}

                    {{--let data = this.editedItem;--}}
                    {{--let index = this.editedIndex;--}}

                    {{--if (this.editedIndex > -1) {--}}

                        {{--axios.post('/user/edit-google-line', {data, index})--}}
                            {{--.then(--}}
                                {{--this.paginatedData[this.editedIndex].status = data[10]--}}
                            {{--);--}}

                    {{--} else {--}}
                        {{--this.lines.push(this.editedItem)--}}
                    {{--}--}}
                    {{--this.close()--}}
                {{--},--}}

                {{--formatDate (date) {--}}
                    {{--if (!date) return null;--}}

                    {{--const [year, month, day] = date.split('-');--}}
                    {{--return `${day}.${month}.${year}`--}}
                {{--},--}}

                {{--changeNum(index) {--}}
                    {{--this.number = index;--}}
                {{--},--}}
                {{--nextPage()  {--}}
                    {{--this.pageNumber++;--}}
                {{--},--}}
                {{--prevPage(){--}}
                    {{--this.pageNumber--;--}}
                {{--}--}}

            {{--},--}}

        {{--})--}}
    {{--</script>--}}
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
@endsection