<template>
    <div class="footer-container container w-100">
        <div class="footer-item w-25">
            <div class="address">
                <p v-html="formattedAddress"></p>
            </div>
        </div>

        <div class="footer-item w-25">
            <div class="logo">
                <div class="loragate_image mb-3">
                    <img :src="academy_details.academy_logo ? `/backend/images/academy/${academy_details.academy_logo}` : '/frontend/images/loregate.png'"
                        width="50" height="50" class="rounded-circle" alt="Logo">
                </div>
                <div class="social_icon d-flex justify-content-center gap-3">
                    <div class="facebook">
                        <a :href="academyMideaLinks.facebook_link">
                            <img src="../../../../public/frontend/images/facebook.png" width="30px" alt="Facebook Icon">
                        </a>

                    </div>
                    <div class="youtube">
                        <a :href="academyMideaLinks.youtube_link">
                            <img src="../../../../public/frontend/images/youtube.png" width="30px" alt="Facebook Icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-item w-50">
            <div class="map rounded-3">
                <iframe :src="mapUrl" width="250" height="130" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>


    </div>
</template>

<script>
import { onMounted, ref, computed } from 'vue';

export default {
    name: "Footer-vue",
    setup() {
        const academy_details = ref({});
        const academyMideaLinks = ref({});
        const fetchMediaLinks = async () => {
            try {
                const response = await axios.get(`/api/media-links`);
                academyMideaLinks.value = response.data.links;
            } catch (error) {
                console.error("Error fetching academy details:", error.message);
            }
        }
        const fetchData = async () => {
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
        const formatAddress = (address) => {
            let formattedAddress = '';
            if (address) {
                const midIndex = Math.floor(address.length / 2);
                const lastSpaceIndex = address.lastIndexOf(' ', midIndex);
                formattedAddress += address.substring(0, lastSpaceIndex) + '<br>';
                formattedAddress += address.substring(lastSpaceIndex + 1);
            }
            return formattedAddress;
        };

        const formattedAddress = computed(() => {
            return academy_details.value.academy_address ? formatAddress(academy_details.value.academy_address) : '';
        });

        const mapUrl = computed(() => {
            const address = academyMideaLinks.value.location_link || "Hatirpool, Dhaka";
            return `https://www.google.com/maps/embed/v1/place?key=AIzaSyA1jvNq7HYUXGfndVFHNgtVZSELnzKwzPY&q=${encodeURIComponent(address)}`;
        });

        onMounted(() => {
            fetchData();
            fetchMediaLinks();
        });

        return {
            academy_details,
            formattedAddress,
            mapUrl,
            fetchMediaLinks,
            academyMideaLinks
        };
    }
};
</script>

<style scoped>
.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    text-align: center;
}

.map iframe {
    border-radius: 5px;
}

.footer-item {
    flex: 1 1 100%;
    max-width: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.address p {
    line-height: 1.5;
    text-align: justify;
}

@media (max-width: 768px) {
    .footer-item {
        margin-top: 10px;
        flex: 0 1 100%;
        max-width: 100%;
        height: 120px;
    }

    .address p {
        text-align: center;
    }
}
</style>
