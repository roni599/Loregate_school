<template>
    <div class="book_details container text-center mb-4">
        <div class="row">
            <div class="col-md-2">
                <router-link to="/home-magazineall" class="text-decoration-none">
                    <p class="text-center bg-danger text-white p-2">মাগাজন</p>
                </router-link>
            </div>
            <div class="col-md-1">
                <p class="text-center bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Education')">
                    Education
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Health')">Health
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Religion')">
                    Religion
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('News')">News</p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Story')">Story
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Poem')">Poem</p>
            </div>
            <div class="col-md-2">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Jokes')">Jokes
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-center  bg-danger text-white p-2 cursor-pointer" @click="getEducationText('Magic')">Magic
                </p>
            </div>
        </div>

        <div class="poster mb-4">
            <div class="row g-3">
                <div v-for="magazine in displayMagazineData" :key="magazine.id" class="col-6  col-lg-3">
                    <router-link :to="`/home-magazinelistview/${magazine.id}`" class="text-decoration-none">
                        <div class="new_education text-center">
                            <img :src="`/backend/images/magazine/${magazine.image}`" :alt="magazine.name"
                                class="img-fluid magazine-img" />
                            <p class="text-black fw-bold mt-3">{{ magazine.heading }}</p>
                            <p class="description pp">
                                {{ truncateDescription(magazine.description) }} <br />
                                <span>{{ formatToBanglaDate(magazine.date) }}</span>
                            </p>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from "moment";
import { useRouter } from "vue-router";
export default {
    name: "Magazine-vue",
    props: {
        magazine: {
            type: Array,
            required: true
        },
        displayMagazineData: {
            type: Object,
            required: true
        }
    },
    setup() {
        const router = useRouter();
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
        const getEducationText = (event) => {
            if (event === 'Health') {
                router.push({ name: "HealthView" });
            }
            else if (event === 'Education') {
                router.push({ name: "EducatonView" })
            }
            else if (event === 'Religion') {
                router.push({ name: 'ReligionView' })
            }
            else if (event === 'News') {
                router.push({ name: 'NewsView' })
            }
            else if (event === 'Story') {
                router.push({ name: 'StoryView' })
            }
            else if (event === 'Poem') {
                router.push({ name: "PoemView" })
            }
            else if (event === 'Jokes') {
                router.push({ name: 'JokesView' })
            }
            else if (event === 'Magic') {
                router.push({ name: 'MagicView' })
            }
            else {
                console.log('not event')
            }
        };
        return {
            truncateDescription,
            formatToBanglaDate,
            getEducationText
        }
    }
}
</script>

<style scoped>
.pp {
    text-align: justify;
    color: black;
}

.cursor-pointer {
    cursor: pointer;
}

.magazine-img {
    width: 308px;
    height: 120px;
}
</style>