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
                                    <label for="inputName">Academy Location / Address</label>
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
        const submitForm = async () => {
            const formData = new FormData();
            formData.append("location", locationLink.value);
            formData.append("facebook_link", facebookLink.value);
            formData.append("youtube_link", youtubeLink.value);

            try {
                const response = await axios.post("/api/media-links/store-update", formData);
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
