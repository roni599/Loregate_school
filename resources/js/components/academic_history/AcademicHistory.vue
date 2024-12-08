<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> / Academic-History</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Academic history Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-2">
                                <div class="col-md-12 mb-4">
                                    <label for="inputHistory">Academy History</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <textarea v-model="history" class="form-control p-3 px-4" id="inputHistory"
                                            style="height: 170px;" placeholder="Enter academy history"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Update Academy-History</span>
                                        <span v-if="loading">Updating Academy-History...</span>
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
export default {
    setup() {
        const academyHistory_id = ref(null);
        const history = ref('');
        const loading = ref(false);

        // const submitForm = async () => {
        //     loading.value = true;
        //     const formData = new FormData();
        //     formData.append('history', history.value);

        //     try {
        //         const response = await axios.post('/api/academy/history', formData);
        //         console.log(response.data.data.id)
        //         if (response) {
        //             findacademyHistory();
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: response.data.message,
        //             });
        //         }
        //     } catch (error) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: error.response?.data?.message || 'An error occurred',
        //         });
        //     } finally {
        //         loading.value = false;
        //     }
        // };

        const submitForm = async () => {
            try {
                const response = await axios.post('/api/academy/history/store-update', {
                    history: history.value,
                })
                if (response) {
                    findacademyHistory();
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: "warning",
                    title: error.response?.data?.message || "An error occurred",
                });
            }
        }

        const findacademyHistory = async () => {
            try {
                const response = await axios.get(`/api/academy/history`)
                if (response) {
                    academyHistory_id.value = response.data.data.id;
                    history.value = response.data.data.history;
                }
            } catch (error) {

            }
        }

        onMounted(() => {
            findacademyHistory();
        })

        return {
            history,
            loading,
            submitForm,
            findacademyHistory,
        };
    },
};
</script>