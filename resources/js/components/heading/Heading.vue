<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> / Heading</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Heading Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitHeading" enctype="multipart/form-data">
                            <!-- Initial Input Field with Plus Icon -->
                            <div class="row mb-4">
                                <div class="col-md-11">
                                    <label for="inputName0">Heading 1</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input v-model="form.heading1" class="form-control" id="inputName0" type="text"
                                            placeholder="Enter academy name" />
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center mt-md-3">
                                    <button type="button" class="btn btn-sm" @click="addInputField"
                                        :disabled="inputFields.length >= 2">
                                        <i class="fa-solid fa-plus rounded-circle bg-success p-1 text-white"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamically Added Input Fields with Minus Icon -->
                            <div v-for="(field, index) in inputFields" :key="index" class="row mb-4">
                                <div class="col-md-11">
                                    <label :for="'inputName' + (index + 1)">Heading {{ index + 2 }}</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" :id="'inputName' + (index + 1)" type="text"
                                            v-model="field.heading" placeholder="Enter academy name" />
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center mt-md-3">
                                    <button type="button" class="btn btn-sm" @click="removeInputField(index)">
                                        <i class="fa-solid fa-minus rounded-circle bg-danger p-1 text-white"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button class="btn btn-info w-100" :disabled="loading">
                                    <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                        aria-hidden="true"></span>
                                    <span v-if="!loading">Edit Heading</span>
                                    <span v-if="loading">Editing Heading...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const inputFields = ref([]);
        const loading = ref(false);
        const heading_id = ref(null);

        const form = reactive({
            heading1: '',
        });
        const addInputField = () => {
            if (inputFields.value.length < 2) {
                inputFields.value.push({ heading: '' });
            }
        };
        const removeInputField = (index) => {
            const headingToDelete = inputFields.value[index];
            if (headingToDelete && headingToDelete.heading) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this heading deletion!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await axios.post('/api/academy/heading/delete', {
                                heading: headingToDelete.heading,
                            });
                            console.log(response)
                            inputFields.value.splice(index, 1);
                            Swal.fire({
                                icon: "success",
                                title: response.data.message || "Heading deleted successfully!",
                            });
                        } catch (error) {
                            // Handle any errors
                            Swal.fire({
                                icon: "error",
                                title: error.response?.data?.message || "An error occurred while deleting the heading.",
                            });
                        }
                    }
                });
            }
        };


        const submitHeading = () => {
            loading.value = true;
            const headings = [form.heading1, ...inputFields.value.map(field => field.heading)];
            const apiEndpoint = '/api/academy/heading/store-update';
            const data = { headings: headings };
            axios.post(apiEndpoint, data)
                .then(response => {
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });

                })
                .catch(error => {
                    Swal.fire({
                        icon: "warning",
                        title: error.response?.data?.message || "An error occurred",
                    });
                })
                .finally(() => {
                    loading.value = false
                })
        };

        const headingDataRetrive = () => {
            axios.get(`/api/academy/heading`)
                .then(response => {
                    heading_id.value = response.data.heading.id;
                    const headings = response.data.heading ? response.data.heading.headings : [];
                    form.heading1 = headings[0] || '';
                    inputFields.value = headings.slice(1).map(heading => ({ heading }));
                })
                .catch(error => {

                });
        }

        onMounted(() => {
            headingDataRetrive();
        });

        return {
            form,
            heading_id,
            inputFields,
            loading,
            addInputField,
            removeInputField,
            submitHeading,
            headingDataRetrive,
            removeInputField
        };
    }
};
</script>

<style scoped>
form .fa-plus,
form .fa-minus {
    cursor: pointer;
}
</style>
