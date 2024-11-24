<template>
    <!-- Container -->
    <div class="web_link_bord_news container d-flex flex-column flex-md-row justify-content-around mb-4 gap-3">
        <!-- Website Link with Table -->
        <div class="col-12 col-md-6 d-flex flex-column align-items-center">
            <!-- Website Link -->
            <div class="link_text_www_image d-flex gap-3 align-items-center justify-content-center mb-3">
                <div class="www_image">
                    <img src="../../../../public/frontend/images/www.png" width="50px" alt="Website Link">
                </div>
                <div class="link_text">
                    <p class="text-danger fw-bold fs-5 mb-0">Website Link</p>
                </div>
            </div>
            <!-- Website Table -->
            <div class="website_link_table w-100">
                <table class="table text-center table-striped table-hover table-bordered">
                    <tbody>
                        <tr v-for="item in webLinks" :key="item.id">
                            <td class="padding">
                                <a :href="item.link" class="text-decoration-none text-dark">{{ item.title }}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Board News with Cards -->
        <div class="col-12 col-md-6 d-flex flex-column align-items-center">
            <!-- Board News -->
            <div class="college_log_notice_bord d-flex gap-3 align-items-center justify-content-center mb-3">
                <div class="college_logo">
                    <img src="../../../../public/frontend/images/Dhaka_College_Seal.svg.png" width="50px"
                        alt="Board News">
                </div>
                <div class="notice_text">
                    <p class="text-info fw-bold fs-5 mb-0">Board News</p>
                </div>
            </div>
            <!-- Board News Cards -->
            <div class="education_all_news w-100">
                <div v-for="boardnews in displayData" :key="boardnews.id" class="card mb-2 gap-2 education_light">
                    <router-link :to="'/home-boardnews/' + boardnews.id" class="text-decoration-none">
                        <div class="card-body text-center bg-info">
                            <p class="fw-bold text-center text-white fs-6 mb-1">{{ boardnews.heading }}</p>
                            <p class="fs-6 text-white">
                                {{ boardnews.description }}
                            </p>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';

export default {
    name: "WebboardNews",
    setup() {

        const webLinks = ref([]);
        const boardNewss = ref([]);

        const displayData = computed(() => boardNewss.value.slice(0, 4))
        const webLinkData = async () => {
            try {
                const response = await axios.get(`/api/academy/weblinkindex`);
                if (response.data.data) {
                    webLinks.value = response.data.data;
                }
            } catch (error) {

            }
        }

        const boardNewsData = async () => {
            try {
                const response = await axios.get('/api/academy/boardnewsindex');
                if (response.data.data) {
                    boardNewss.value = response.data.data
                }
            } catch (error) {

            }
        }
        onMounted(() => {
            webLinkData(),
                boardNewsData()
        })
        return {
            webLinks,
            boardNewss,
            displayData
        }
    }
}
</script>

<style scoped>
.padding {
    padding: 18px;
}

.router-link-active,
.router-link-exact-active,
.router-link {
    text-decoration: none !important;
}
</style>