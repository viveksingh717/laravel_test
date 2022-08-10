<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Employee</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Emp Name</label>
                                    <input type="text" class="form-control" v-model="emp.employee_name">
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="3" v-model="emp.address"></textarea>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="emp.email">
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" v-model="emp.phone">
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Date_Of_Birth</label>
                                    <input type="date" class="form-control" v-model="emp.date_of_birth">
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Emp Image</label>
                                    <input type="file" class="form-control" v-on:change="onFileChange">
                                </div>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { create } from 'domain';

export default {
    name:"add",
    data(){
        return {
            emp:{
                employee_name:"",
                address:"",
                email:"",
                phone:"",
                date_of_birth:"",
                employee_image:"",
            }
        }
    },

    methods: {
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
   
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
    
                let formData = new FormData();
                formData.append('employee_image', this.file);

                axios.post('/api/store', formData, config)
                .then(function (response) {
                    this.$router.push({name:"list"})
                })
                .catch(function (error) {
                    console.log(error)
                });
            }
        }


}
</script>