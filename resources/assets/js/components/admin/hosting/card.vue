<template>
    <div class="hosting-card">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 acc-data">

                    <p class="label">ПІБ:</p>
                    <p class="pib">{{hosting.last_name}} {{hosting.name}} {{hosting.second_name}}</p>

                    <p class="label">Телефон:</p>
                    <p class="phone">{{hosting.phone}}</p>

                    <p class="label">Послуги:</p>
                    <div class="conditions" v-for="condition in hosting.conditions">
                        <div v-if="condition.condition == 'hosting'" class="mark-primary mark">Хостинг - {{condition.amount}} UAH</div>
                        <div v-else-if="condition.condition == 'cert'" class="mark-orange mark">Сертифікат - {{condition.amount}} UAH</div>
                        <div v-else-if="condition.condition == 'support'" class="mark-red mark" >Підтримка - {{condition.amount}} UAH</div>
                        <div v-else></div>

                    </div>

                    <br>


                </div>

                <div class="col-md-8 message-box">
                    <div class="message-list" id="block-scroll">
                        <div class="message-item" v-for="comment in hosting.comments">
                            <div class="message-image">
                            </div>
                            <div class="message-content">
                                <div class="message-time">
                                    {{editDate(comment.created_at)}}
                                </div>
                                <div class="message-email">
                                    {{comment.user.email}}
                                </div>
                                <div class="message-text">
                                    {{comment.message}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="writing-block">
                        <span class="error" v-if="errors.comment">{{errors.comment[0]}}</span>
                        <textarea name="comment" v-model="data.comment"  class="form-control"></textarea>
                        <br>

                        <button class="btn-create" @click="comment">Відправити</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                title: "Hostings",
                data: {
                    comment: "",
                    hosting_id: this.hosting.id,
                },
                errors: {},
            }
        },
        props: ['hosting'],
        mounted () {
            this.scrollToEnd();
        },
        updated() {
            this.scrollToEnd();

        },
        methods: {

            comment(){
                this.$http.post('/admin/hostings/account/'+this.hosting.id+'/comment', this.data).then(res => {
                    if (res.status === 201) {
                        // console.log(res.data)
                        location.href = '/admin/hostings/account/'+this.hosting.id
                    }
                    else {

                    }
                }, err => {
                    this.errors = err.data.errors
                })
            },

            editDate(date){
                if(date){
                    var dateT = date.split(' ')['0']
                    var timeT = date.split(' ')['1']
                    var dateTemp = dateT.split('-')
                    var timeTemp = timeT.split(':')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0'] + ' ' + timeTemp['0'] + ':' + timeTemp['1']

                    return date
                }
                else {
                    return date
                }

            },
            scrollToEnd(){
                let block = document.querySelector("#block-scroll");
                block.scrollTop = block.scrollHeight;
            },

        }

    };
</script>

<style>
    .error{
        color: red;
    }
</style>