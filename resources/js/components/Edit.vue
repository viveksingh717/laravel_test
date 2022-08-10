<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Employee</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="formUpdate" enctype="multipart/form-data">
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
export default {
    name:"edit",
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
    mounted(){
        this.showEmp()
    },
    methods:{
        async showEmp(){
            await this.axios.get(`/api/show/${this.$route.params.id}`).then(response=>{
                const { employee_name, address, email, phone, date_of_birth, employee_image } = response.data
                this.emp.employee_name = employee_name
                this.emp.address = address
                this.emp.email = email
                this.emp.phone = phone
                this.emp.date_of_birth = date_of_birth
                this.emp.employee_image = employee_image
            }).catch(error=>{
                console.log(error)
            })
        },
        async formUpdate(){
            await this.axios.post(`/api/update/${this.$route.params.id}`,this.emp).then(response=>{
                this.$router.push({name:"list"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>