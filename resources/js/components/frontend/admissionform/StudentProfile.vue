<template>
    <div class="main-div ">
        <div class="container-fluid admissionfair mb-3">
            <div class="contentload w-100 d-flex justify-content-between align-items-center mt-2 mt-lg-3">
                <div class="content-image-academy-details d-flex align-items-center">
                    <button class="btn btn-transparent p-0 border-0 academy-image" @click="Gohome">
                        <img v-if="academy_details.academy_logo"
                            :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
                            class="rounded-circle me-2" alt="Academy Logo">
                    </button>
                    <div class="academy-details text-white" style="line-height: 1">
                        <template v-if="isMobile && isLongName">
                            <marquee class="m-0 education_font_size">
                                {{ academy_details.academy_name || "Loregate School and College" }}
                            </marquee>
                        </template>
                        <template v-else>
                            <p class="m-0 education_font_size">
                                {{ academy_details.academy_name || "Loregate School and College" }}
                            </p>
                        </template>
                        <span class="d-block education_font">
                            <span
                                v-html="formatAddress(academy_details.academy_address || 'Address not available')"></span>
                        </span>
                        <span class="d-block education_font">
                            {{ academy_details.academy_mobile_number || "Phone not available" }}
                        </span>
                    </div>
                </div>
                <div class="admissionfaircontent d-flex justify-content-end align-items-center mt-2 mt-lg-3 ms-4">
                    <router-link class="text-white h5" to="/logout">Logout</router-link>
                </div>
            </div>
        </div>
        <div class="position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center w-50">
            <router-link to="/studentadmission-table" class="btn btn-sm btn-success w-100 mb-3 p-2">View Your Admission Form</router-link>
            <router-link to="/admissionform" class="btn btn-sm btn-info w-100">Apply Admission</router-link>
        </div>


    </div>
</template>

<script>
import { onMounted, ref, computed } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
export default {
    name: "StudentProfile",
    setup() {
        const router = useRouter();
        const academy_details = ref({});
        const isMobile = ref(false);

        const fetchAcademy = async () => {
            try {
                const response = await axios.get(`/api/academy/header`);
                if (response.data?.data) {
                    academy_details.value = response.data.data;
                    document.title = academy_details.value.academy_name || "Loregate School and College";
                    if (academy_details.value.academy_logo) {
                        const faviconElement = document.getElementById('dynamic-favicon');
                        if (faviconElement) {
                            faviconElement.href = `/backend/images/academy/${academy_details.value.academy_logo}`;
                        }
                    }
                }
            } catch (error) {
                console.error("Error fetching academy details:", error.message);
            }
        };
        const isLongName = computed(() =>
            (academy_details.value.academy_name || "Loregate School and College").length > 26
        );
        const checkScreenSize = () => {
            isMobile.value = window.innerWidth <= 768;
        };
        const Gohome = () => {
            router.push({ name: "HomeFront" })
        }
        const formatAddress = (address) => {
            let formattedAddress = '';
            let i = 0;
            while (i < address.length) {
                formattedAddress += address.substring(i, i + 50) + '<br>';
                i += 50;
            }
            return formattedAddress;
        };
        onMounted(() => {
            fetchAcademy();
        })

        return {
            Gohome,
            fetchAcademy,
            academy_details,
            isMobile,
            isLongName,
            checkScreenSize,
            formatAddress
        }
    }
}
</script>

<style scoped>
.addmissionlogin {
    background-color: #e7def7;
}

.loginbutton {
    background-color: #d00473;
    border-radius: 15px;
    padding: 5px 15px;
}

.createaccount {
    border-radius: 25px;
    padding: 5px 30px;
    background-color: #004aac;
    border: none;
}

.onlineadmission {
    color: #5586c7;
}

.onlineadmission {
    color: #5586c7;
}

.admissionfair {
    width: 100%;
    height: 12vh;
    background-color: #d00473;
}

.academy-details p {
    line-height: 0.9;
    color: white;
}
</style>
