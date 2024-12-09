<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Application-report</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Application Report</p>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "ApplicationReport",
    setup() {
        const admissionReport=ref([]);
        const fetchAdmissionData=async()=>{
            try {
                const response=await axios.get(`/api/studentadmissions`);
                console.log(response)
            } catch (error) {
                
            }
        }
        onMounted(()=>{
            fetchAdmissionData();
        })
        return {
            admissionReport,
            fetchAdmissionData

        }
    }
}
</script>

<style></style>