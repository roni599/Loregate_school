<template>
    <div class="container">
        <div class="magzine_details_all py-5 mb-3 d-flex justify-content-center align-items-center">
            <img class="magazine-image" src="../../../../public/frontend/images/Magazine_image.png"
                alt="Magazine Image">
        </div>
        <!-- magazine -->
        <div class="book_details container mb-4">
            <div class="row px-4">
                <div class="col-md-2">
                    <p class="text-center bg-danger text-white p-2">Magazine</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">Education</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">Health</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">Religion</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">News</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">story</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">poem</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">jokes</p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2">Natural</p>
                </div>
                <div class="col-md-2">
                    <p class="text-center  bg-danger text-white p-2">Magic</p>
                </div>
            </div>
        </div>

        <!-- magazineList -->
        <div class="poster container mb-4 text-center">
            <div class="row px-4">
                <div v-for="magazine in magazinelists" :key="magazine.id" class="col-6 col-md-3 mb-3 ">
                    <router-link :to="`/home-magazinelistview/${magazine.id}`" class="text-decoration-none">
                        <div class="new_education">
                            <img src="../../../../public/frontend/images/profile1.png" width="100px" alt="">
                        </div>
                        <p>{{ magazine.heading }}</p>
                        <p class="description">{{ truncateDescription(magazine.description) }} <br> <span
                                class="mt-1">{{ formatToBanglaDate(magazine.date) }}</span></p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import moment from "moment";

export default {
    name: "MagazineAll",
    setup() {
        const magazinelists = ref([]);
        const magazineListData = async () => {
            try {
                const response = await axios.get(`/api/academy/magazine`);
                if (response.data.data) {
                    magazinelists.value = response.data.data;
                }
            } catch (error) {

            }
        }
        const formatToBanglaDate = (date) => {
            if (!date) return "";
            const formattedDate = moment(date).format("DD/MM/YYYY");
            return formattedDate
                .split("/")
                .map((num) => convertToBanglaNumber(num))
                .join("/");
        };

        const convertToBanglaNumber = (number) => {
            const banglaDigits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
            return number.toString().split("").map((digit) =>
                banglaDigits[digit] || digit
            ).join("");
        };

        const truncateDescription = (description) => {
            if (!description) return "";
            const words = description.split(" ");
            if (words.length > 50) {
                return words.slice(0, 25).join(" ") + " [...]";
            }
            return description;
        };

        onMounted(() => {
            magazineListData()
        })
        return {
            magazinelists,
            magazineListData,
            formatToBanglaDate,
            truncateDescription

        }
    }
}
</script>

<style scoped>
.description {
    text-align: justify;
}
</style>