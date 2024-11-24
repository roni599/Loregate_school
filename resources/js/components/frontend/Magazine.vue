<template>
    <div class="book_details container mb-4">
        <div class="row px-4">
            <div class="col-md-2">
                <router-link to="/home-magazineall" class="text-decoration-none">
                    <p class="text-center bg-danger text-white p-2">মাগািজন</p>
                </router-link>
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
            <div class="col-md-2">
                <p class="text-center  bg-dark text-white p-2">jokes</p>
            </div>
            <div class="col-md-2">
                <p class="text-center  bg-danger text-white p-2">Magic</p>
            </div>
        </div>
    </div>

    <!-- magazineList -->
    <div class="poster container mb-4">
        <div class="row px-4">
            <div v-for="magazine in displayData" :key="magazine.id" class="col-6 col-md-3 mb-3 ">
                <div class="new_education text-center">
                    <img class="mb-3" src="../../../../public/frontend/images/profile1.png" width="100px" alt="">
                    <p>{{ magazine.heading }}</p>
                    <p class="description pp">{{ truncateDescription(magazine.description) }} <br> <span class="mt-1">{{
                        formatToBanglaDate(magazine.date) }}</span></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import moment from "moment";
export default {
    name: "Magazine-vue",
    setup() {
        const magazine = ref([]);
        const magazineData = async () => {
            try {
                const response = await axios.get(`/api/academy/magazine`);
                if (response.data.data) {
                    magazine.value = response.data.data
                }
            } catch (error) {

            }
        }
        const displayData = computed(() => magazine.value.slice(0, 4))
        const truncateDescription = (description) => {
            if (!description) return "";
            const words = description.split(" ");
            if (words.length > 50) {
                return words.slice(0, 25).join(" ") + " [...]";
            }
            return description;
        };

        const convertToBanglaNumber = (number) => {
            const banglaDigits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
            return number.toString().split("").map((digit) =>
                banglaDigits[digit] || digit
            ).join("");
        };

        const formatToBanglaDate = (date) => {
            if (!date) return "";
            const formattedDate = moment(date).format("DD/MM/YYYY");
            return formattedDate
                .split("/")
                .map((num) => convertToBanglaNumber(num))
                .join("/");
        };

        onMounted(() => {
            magazineData();
        })
        return {
            magazine,
            magazineData,
            displayData,
            truncateDescription,
            formatToBanglaDate
        }
    }
}
</script>

<style scoped>
.pp {
    text-align: justify;
}
</style>