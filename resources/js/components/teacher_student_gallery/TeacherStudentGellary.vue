<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Teacher-Student-Gallery</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Teacher-Student-Gallery Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-md-12 mb-2">
                                    <label for="teacherStaffQty">Teacher/Staff Qty</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input v-model="teacherStaffQty" class="form-control p-3 px-4"
                                            id="teacherStaffQty" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12 mb-2">
                                    <label for="studentQty">Student Qty</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input v-model="studentQty" class="form-control p-3 px-4" id="studentQty"
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Update Teacher-Student-Qty
                                        </span>
                                        <span v-if="loading">Update Teacher-Student-Qty...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    setup() {
        const teacherStaffQty = ref('');
        const studentQty = ref('');
        const loading = ref(false);

        // const submitForm = async () => {
        //     loading.value = true;
        //     try {
        //         const response = await axios.post('/api/academy/staff-data', {
        //             teacher_staff_qty: teacherStaffQty.value,
        //             student_qty: studentQty.value,
        //         });

        //         if (response) {
        //             resetForm();
        //             Swal.fire({
        //                 icon: "success",
        //                 title: response.data.message,
        //             });
        //         }
        //     } catch (error) {
        //         Swal.fire({
        //             icon: "warning",
        //             title: error.response?.data?.message || "An error occurred",
        //         });
        //     } finally {
        //         loading.value = false;
        //     }
        // };

        const submitForm = async () => {
            loading.value = true;
            try {
                const response = await axios.post('/api/academy/staff-data/store-update', {
                    teacher_staff_qty: teacherStaffQty.value,
                    student_qty: studentQty.value,
                });
                if (response.data && response.data.message) {
                    findStaffData()
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: "warning",
                    title: error.response?.data?.message || "An error occurred",
                });
            } finally {
                loading.value = false;
            }
        };

        const resetForm = () => {
            teacherStaffQty.value = '';
            studentQty.value = '';
        };

        const findStaffData = async () => {
            const response = await axios.get(`/api/academy/staff-data`)
            teacherStaffQty.value = response.data.data.teacher_staff_qty;
            studentQty.value = response.data.data.student_qty

        }
        onMounted(() => {
            findStaffData();
        })

        return {
            teacherStaffQty,
            studentQty,
            loading,
            submitForm,
            resetForm,
            findStaffData,
        };
    },
};
</script>

<style>
/* Add any styling you need here */
</style>