<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Primeminester-President</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Left-Picture Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="inputPrimeMinisterName">Prime Minister Name</label>
                                    <input v-model="form.prime_minister_name" class="form-control p-3 px-4"
                                        id="inputPrimeMinisterName" type="text" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="inputPrimeMinisterDesignation">Prime Designation</label>
                                    <input v-model="form.prime_minister_designation" class="form-control p-3 px-4"
                                        id="inputPrimeMinisterDesignation" type="text" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="inputPrimeMinisterImage">Prime Minister Picture</label>
                                    <input @change="onFileSelect($event, 'prime_minister_image')"
                                        class="form-control p-3 px-4" id="inputPrimeMinisterImage" type="file" />
                                    <img v-if="form.prime_minister_image" :src="form.prime_minister_image" width="55"
                                        height="55" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="inputPresidentName">President Name</label>
                                    <input v-model="form.president_name" class="form-control p-3 px-4"
                                        id="inputPresidentName" type="text" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="inputPresidentDesignation">President Designation</label>
                                    <input v-model="form.president_designation" class="form-control p-3 px-4"
                                        id="inputPresidentDesignation" type="text" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="inputPresidentImage">President Picture</label>
                                    <input @change="onFileSelect($event, 'president_image')"
                                        class="form-control p-3 px-4" id="inputPresidentImage" type="file" />
                                    <img v-if="form.president_image" :src="form.president_image" width="55"
                                        height="55" />
                                </div>
                            </div>
                            <button class="btn btn-info w-100" type="submit" :disabled="loading">
                                <span v-if="loading">Saving...</span>
                                <span v-else>Save</span>
                            </button>
                        </form>
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
    name: "PrimeminesterPresident",
    setup() {
        const loading = ref(false);
        const form = ref({
            prime_minister_name: '',
            prime_minister_designation: '',
            prime_minister_image: null,
            president_name: '',
            president_designation: '',
            president_image: null,
        });
        const academy_id = ref(1)

        const onFileSelect = (event, imageType) => {
            const file = event.target.files[0];
            if (file && file.size > 1048576) {
                alert('Image must be less than 1 MB');
            } else if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    form.value[imageType] = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        // const submitForm = async () => {
        //     loading.value = true;
        //     const formData = new FormData();
        //     formData.append('prime_minister_name', form.value.prime_minister_name);
        //     formData.append('prime_minister_designation', form.value.prime_minister_designation);
        //     formData.append('prime_minister_image', form.value.prime_minister_image);
        //     formData.append('president_name', form.value.president_name);
        //     formData.append('president_designation', form.value.president_designation);
        //     formData.append('president_image', form.value.president_image);

        //     try {
        //         const response = await axios.post('/api/academy/prime-presedent', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data',
        //             },
        //         });
        //         if (response.data) {
        //             resetForm();
        //             findData()
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: response.data,
        //             });
        //         }
        //     } catch (error) {
        //         console.error(error);
        //         Swal.fire({
        //             icon: 'error',
        //             title: error.response?.data?.message || 'An error occurred',
        //         });
        //     } finally {
        //         loading.value = false;
        //     }
        // };

        const submitForm = async () => {
            loading.value = true;
            const formData = new FormData();
            formData.append('prime_minister_name', form.value.prime_minister_name);
            formData.append('prime_minister_designation', form.value.prime_minister_designation);
            formData.append('prime_minister_image', form.value.prime_minister_image);
            formData.append('president_name', form.value.president_name);
            formData.append('president_designation', form.value.president_designation);
            formData.append('president_image', form.value.president_image);
            try {
                const response = await axios.post('/api/academy/prime-presedent/store-update', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                if (response.data) {
                    findData()
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                
            }finally{
                loading.value=false
            }
        }
        const findData = async () => {
            const response = await axios.get(`/api/academy/prime-presedent`)
            form.value.prime_minister_name = response.data.data.prime_minister_name;
            form.value.prime_minister_designation = response.data.data.prime_minister_designation;
            form.value.president_name = response.data.data.president_name;
            form.value.president_designation = response.data.data.president_designation
            form.value.prime_minister_image = response.data.data.prime_minister_image;
            form.value.president_image = response.data.data.president_image;

            Object.keys(form.value).forEach(async (key) => {
                if (key === 'prime_minister_image' || key === 'president_image') {
                    const imagePath = `/backend/images/primepresedent/${form.value[key]}`;

                    try {
                        const imageResponse = await fetch(imagePath);
                        const imageBlob = await imageResponse.blob();
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            form.value[key] = reader.result;
                        };
                        reader.readAsDataURL(imageBlob);
                    } catch (error) {
                        console.error(`Error fetching image for ${key}:`, error);
                    }
                }
            });
        }
        const resetForm = () => {
            form.value.prime_minister_name = '';
            form.value.prime_minister_designation = '';
            form.value.prime_minister_image = null;
            form.value.president_name = '';
            form.value.president_designation = '';
            form.value.president_image = null;
        };

        onMounted(() => {
            findData()
        })

        return {
            form,
            loading,
            onFileSelect,
            submitForm,
            findData,
            academy_id
        }
    }
}
</script>

<style></style>