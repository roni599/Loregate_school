<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Previous-Academy-information</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Previous Academy Information</h5>
                    </div>
                    <div class="card-body mb-3">

                        <div class="ms-3">
                            <div class=" mb-3">
                                <h3 class="mb-3">Education Name(Depold)</h3>
                                <ul class="list-group container ms-3">
                                    <li v-for="education in previousEducations" :key="education.id">
                                        {{ education.education_name }}
                                    </li>
                                </ul>
                            </div>
                            <div @click="toggleInput"
                                class="d-flex align-items-center cursor mb-4 text-primary fw-bold">
                                <i class="fa-solid fa-plus" @click="toggleInput"></i>
                                <span class="ms-2">Add New</span>
                            </div>
                            <form v-if="isInputVisible" @submit.prevent="submitForm">
                                <input v-model="newItem" type="text" class="form-control mb-3"
                                    placeholder="Add Education Name" />
                                <button class="btn btn-primary mt-2 w-100">Save</button>
                            </form>
                        </div>
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
    name: "PreviousinformationAcademy",
    setup() {
        const isInputVisible = ref(false);
        const newItem = ref("");
        const previousEducations = ref([]);
        const toggleInput = () => {
            isInputVisible.value = !isInputVisible.value;
        };
        const submitForm = async () => {

            try {
                const response = await axios.post(`/api/previous-educations/store`, {
                    newItem: newItem.value
                })
                if (response.data && response.data.message) {
                    fetchEducation();
                    resetForm()
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.log(error)
            }
        };
        const fetchEducation = async () => {
            try {
                const response = await axios.get(`/api/previous-educations`);
                if (response.data && response.data.message) {
                    previousEducations.value = response.data.data;
                }
            } catch (error) {

            }
        }
        const resetForm = () => {
            newItem.value = ''
        }

        onMounted(() => {
            fetchEducation();
        })
        return {
            isInputVisible,
            newItem,
            toggleInput,
            submitForm,
            resetForm,
            previousEducations
        };
    },
}
</script>

<style scoped>
.cursor {
    cursor: pointer;
}
</style>