<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"add"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employees</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date_Of_Birth</th>
                                    <th>Employee_Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="employees.length > 0">
                                <tr v-for="(emp,key) in employees" :key="key">
                                    <td>{{ emp.id }}</td>
                                    <td>{{ emp.employee_name }}</td>
                                    <td>{{ emp.address }}</td>
                                    <td>{{ emp.email }}</td>
                                    <td>{{ emp.phone }}</td>
                                    <td>{{ emp.date_of_birth }}</td>
                                    <td>{{ emp.employee_image }}</td>
                                    <td>
                                        <router-link :to='{name:"edit",params:{id:emp.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteEmp(emp.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Data Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"employees",
    data(){
        return {
            employees:[]
        }
    },
    mounted(){
        this.getEmployee()
    },
    methods:{
        async getEmployee(){
            await this.axios.get('/api/index').then(response=>{
                this.employees = response.data
            }).catch(error=>{
                console.log(error)
                this.employees = []
            })
        },
        deleteEmp(id){
            if(confirm("Are you sure to delete this Emp ?")){
                this.axios.delete(`/api/destroy/${id}`).then(response=>{
                    this.getEmployee()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>