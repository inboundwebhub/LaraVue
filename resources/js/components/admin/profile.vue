<template>
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user cover">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div id="cover" class="widget-user-header text-white"
                         style="background: url('img/profile-cover.jpg') center center;">
                        <h3 class="widget-user-username">{{userInfo.name}}</h3>
                        <h5 class="widget-user-desc">{{userInfo.bio}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getPhoto()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="activity">
                                No activity found.
                            </div>
                            <!-- /.tab-pane -->


                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email"
                                                   v-model="form.email" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bio" class="col-sm-2 control-label">Bio</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="bio" name="Bio"
                                                      placeholder="Bio" v-model="form.bio" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>

                                        <div class="col-sm-10">
                                            <input type="file" @change="updateProfile"  id="photo" name="photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-10 control-label">Password  (leave empty if not changing)</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" @click.prevent=updateInfo class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                userInfo:[],
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: '',
                })
            }
        },
        mounted(){
            // console.log('component mounted')
        },
        methods:{
            getPhoto(){
                let pic = (this.form.photo.length>100)? this.form.photo :"img/profile/"+this.form.photo ;
                return "img/profile/"+this.userInfo.photo;
            },
            updateInfo(){
                this.$Progress.start();
                this.form.put('api/profile')
                    .then(() => {
                        toast({
                            type: 'success',
                            title: 'Profile Updated Successfully.'
                        })
                        this.$Progress.finish();
                        fire.$emit('profileRefresh');
                    }).catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){

                // console.log('uploading...');
                let file = e.target.files[0];
                // console.log(file);
                let reader = new FileReader();
                if(file['size']<1000000){
                    reader.onloadend = (file)=> {
                        // console.log('RESULT', reader.result)
                        this.form.photo=reader.result;
                    }
                    reader.readAsDataURL(file);
                }else{
                    swal(
                        'Oops!',
                        'Your image is too large.',
                        'error'
                    )
                }


            }
        },
        created(){
            axios.get('api/profile')
                .then(({data}) =>{
                    this.form.fill(data);
                    this.userInfo=data;
                });
            fire.$on('profileRefresh',()=>{
                axios.get('api/profile')
                    .then(({data}) =>{
                        this.form.fill(data);
                        this.userInfo=data;
                    });
            });
        }
    }
</script>
<style>
    .widget-user .widget-user-image > img{
        width: 130px;
    }
    #cover {
        background-position: center center;
        height: 200px;
    }
</style>