<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5"
                    to="/admin-dashboard">Dashboard</router-link><span class="text-muted h5"> / MediaLink</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p><i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Medialink Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" @submit.prevent="submitForm">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="inputName">Location Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" v-model="locationLink" type="text"
                                            placeholder="Enter your name" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="inputAddress">Facebook Page Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputAddress" v-model="facebookLink" type="text"
                                            placeholder="Address" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="inputSalary">YouTube Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSalary" v-model="youtubeLink" type="text"
                                            placeholder="Salary" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading" type="submit">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Media Link</span>
                                        <span v-if="loading">Editing Media Link...</span>
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
import { onMounted, ref } from "vue";
import axios from "axios";
export default {
    setup() {
        const locationLink = ref("");
        const facebookLink = ref("");
        const youtubeLink = ref("");
        const loading = ref(false);

        // const submitForm = async () => {
        //     loading.value = true;
        //     try {
        //         const response = await axios.post("/api/media-links", {
        //             location_link: locationLink.value,
        //             facebook_link: facebookLink.value,
        //             youtube_link: youtubeLink.value,
        //         });
        //         locationLink.value = "";
        //         facebookLink.value = "";
        //         youtubeLink.value = "";
        //     } catch (error) {
        //         console.log(error)
        //     } finally {
        //         loading.value = false;
        //     }
        // };
        const submitForm = async () => {
            const formData = new FormData();
            formData.append("location_link", locationLink.value);
            formData.append("facebook_link", facebookLink.value);
            formData.append("youtube_link", youtubeLink.value);

            try {
                const response = await axios.post("/api/media-links/store-update", formData);
                console.log(response)
                if (response) {
                    loadURL()
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error(error);
            }
        }

        const loadURL = async () => {
            try {
                const response = await axios.get(`/api/media-links`);
                locationLink.value = response.data.links.location_link;
                facebookLink.value = response.data.links.facebook_link;
                youtubeLink.value = response.data.links.youtube_link;
            } catch (error) {
                console.log("Error fetching media links:", error);
            }
        }
        onMounted(async () => {
            loadURL()
        })
        return {
            loading,
            locationLink,
            facebookLink,
            youtubeLink,
            loading,
            submitForm,
            loadURL
        };
    },
};
</script>

<style></style>
<!-- 
<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none h5" to="/home">Dashboard</router-link><span
                    class="text-muted h5"> / MediaLink</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p><i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Header Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" class="py-5" @submit.prevent="submitForm">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="inputName">Location Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" v-model="locationLink" type="text"
                                            placeholder="Enter location" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="inputAddress">Facebook Page Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputAddress" v-model="facebookLink" type="text"
                                            placeholder="Enter Facebook link" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="inputSalary">YouTube Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSalary" v-model="youtubeLink" type="text"
                                            placeholder="Enter YouTube link" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary w-100 mb-2" :disabled="loading" type="submit">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Media Link</span>
                                        <span v-if="loading">Editing Media Link...</span>
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
import { onMounted, ref, reactive } from "vue";
import axios from "axios";

export default {
    setup() {
        const locationLink = ref("");
        const facebookLink = ref("");
        const youtubeLink = ref("");
        const loading = ref(false);

        // Store the original values to compare later
        const originalValues = reactive({
            location_link: "",
            facebook_link: "",
            youtube_link: "",
        });

        const submitForm = async () => {
            loading.value = true;

            // Create an object to store only the changed fields
            const changedFields = {};

            if (locationLink.value !== originalValues.location_link) {
                changedFields.location_link = locationLink.value;
            }
            if (facebookLink.value !== originalValues.facebook_link) {
                changedFields.facebook_link = facebookLink.value;
            }
            if (youtubeLink.value !== originalValues.youtube_link) {
                changedFields.youtube_link = youtubeLink.value;
            }

            if (Object.keys(changedFields).length === 0) {
                loading.value = false;
                return;
            }

            try {
                // Send only the changed fields to the backend
                await axios.put("/api/media-links/update", changedFields);
                // Update original values with new data after successful save
                Object.assign(originalValues, changedFields);
            } catch (error) {
                console.log("Error updating media links:", error);
            } finally {
                loading.value = false;
            }
        };

        onMounted(async () => {
            try {
                const id = 1; // Assuming the id is 1; adjust as needed
                const response = await axios.get(`/api/media-find/${id}`);
                locationLink.value = response.data.links.location_link;
                facebookLink.value = response.data.links.facebook_link;
                youtubeLink.value = response.data.links.youtube_link;

                // Initialize original values with the fetched data
                originalValues.location_link = response.data.links.location_link;
                originalValues.facebook_link = response.data.links.facebook_link;
                originalValues.youtube_link = response.data.links.youtube_link;
            } catch (error) {
                console.log("Error fetching media links:", error);
            }
        });

        return {
            loading,
            locationLink,
            facebookLink,
            youtubeLink,
            submitForm,
        };
    },
};
</script>

<style></style> -->
