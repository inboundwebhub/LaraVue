<template>
    <div class="box" style="width: 50%;margin: 0 auto;">

        <article class="message is-info">
            <div class="message" v-for="(s, index) in statuses" :key="index">
                <div class="message-header">
                    <p>
                        {{index+1}}. {{s.author}} Said <i class="fas fa-info-circle"></i>
                    </p>
                    <p>
                        {{s.created_at}}({{postedOn(s)}})
                    </p>
                    <button @click="deleteStatus(index)" class="delete"></button>
                </div>

                <div class="message-body" v-text="s.body">
                    Hello
                </div>
            </div>
        </article>
        <div class="message">

            <form @submit.prevent="createStatus">

                <div class="message-header">
                    <input type="text" name="name" id="name" v-on:keyup="clear1" placeholder="Author" v-model="name"
                           class="input">
                </div>
                <div class="help has-text-danger" style="margin-left: 5px" v-if="errorname">
                    {{ errorname }}
                </div>

                <div class="message-body">
                        <textarea id="body" name="comment" v-model="comment" v-on:keyup="clear2"
                                  placeholder="I want to say something..."
                                  class="textarea"></textarea>
                    <div class="help has-text-danger" v-if="errorcomment">
                        {{ errorcomment }}
                    </div>
                    <p class="control">
                        <br/>
                        <button class="button is-primary"> Submit</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';
    export default {
        data() {
            return {
                name: '',
                comment: '',
                errorname: null,
                errorcomment: null,
                statuses: [],
            }
        },
        mounted() {
            this.created();
        },

        methods: {
            created() {
                //ajax
                axios.get('/statuses')
                    .then(({data}) => this.statuses = data)
            },
            postedOn(status) {
                return moment(status.created_at).fromNow();
            },

            createStatus() {
                var self = this;
                if (self.name == "") {
                    self.errorname = "Name is required.";
                }
                if (self.comment == "") {
                    self.errorcomment = "Comment is required.";
                }

                axios.post('/statuses', {
                    name: self.name,
                    comment: self.comment,
                })
                    .then(response => {
                        toastr.success('Added Successfully !')
                        self.statuses.unshift(response.data.status);
                        self.reset();

                    })

            },
            reset() {
                this.name = '';
                this.comment = '';
            },
            clear1: function () {
                this.errorname = null;
            },
            clear2: function () {
                this.errorcomment = null;
            },
            deleteStatus(index) {
                let conf = confirm("Do you ready want to delete this Status?");
                if (conf === true) {

                    axios.delete('/statuses/' + this.statuses[index].id)
                        .then(response => {

                            this.statuses.splice(index, 1);
                            toastr.error('Status Deleted.')
                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>
<style></style>