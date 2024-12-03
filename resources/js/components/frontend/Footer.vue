<!-- <template>
    <div class="footer-container container w-100">
        <div class="footer-item w-25">
            <div class="address">
                <p>{{ academy_details.academy_address }}</p>
            </div>
        </div>
        <div class="footer-item w-25">
            <div class="logo">
                <div class="loragate_image mb-3">
                    <img src="../../../../public/frontend/images/loregate.png" width="50" height="50"
                        class="rounded-circle" alt="Logo">
                </div>
                <div class="social_icon d-flex justify-content-center gap-3">
                    <div class="facebook">
                        <img src="../../../../public/frontend/images/facebook.png" width="30px" alt="Facebook Icon">
                    </div>
                    <div class="youtube">
                        <img src="../../../../public/frontend/images/youtube.png" width="30px" alt="YouTube Icon">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-item w-50">
            <div class="map rounded-3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.8576475601875!2d90.3766180154334!3d23.744499194424452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf5657e690d1%3A0x8c4e1ef807124acb!2sHatirpool%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1691610379267!5m2!1sen!2sbd"
                    width="250px" height="130px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</template>


<script>
import { onMounted, ref } from 'vue';
export default {
    name: "Footer-vue",
    setup() {
        const academy_details = ref({});
        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/academy/header`);
                if (response.data?.data) {
                    academy_details.value = response.data.data;
                    console.log(academy_details.value)
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
        onMounted(() => {
            fetchData()
        })
        return {
            fetchData,
            academy_details
        }
    }
}
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
    line-height: 0;
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
</style> -->

<template>
    <div class="footer-container container w-100">
        <div class="footer-item w-25">
            <div class="address">
                <!-- Display formatted address -->
                <p v-html="formattedAddress"></p>
            </div>
        </div>

        <div class="footer-item w-25">
            <div class="logo">
                <div class="loragate_image mb-3">
                    <!-- Dynamically set the logo if it exists -->
                    <img :src="academy_details.academy_logo ? `/backend/images/academy/${academy_details.academy_logo}` : '/frontend/images/loregate.png'"
                        width="50" height="50" class="rounded-circle" alt="Logo">
                </div>
                <div class="social_icon d-flex justify-content-center gap-3">
                    <div class="facebook">
                        <img src="../../../../public/frontend/images/facebook.png" width="30px" alt="Facebook Icon">
                    </div>
                    <div class="youtube">
                        <img src="../../../../public/frontend/images/youtube.png" width="30px" alt="YouTube Icon">
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="footer-item w-50">
            <div class="map rounded-3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.8576475601875!2d90.3766180154334!3d23.744499194424452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf5657e690d1%3A0x8c4e1ef807124acb!2sHatirpool%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1691610379267!5m2!1sen!2sbd"
                    width="250px" height="130px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div> -->

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

        // Fetch data for academy details
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

        // Method to format the address with line breaks
        const formatAddress = (address) => {
            let formattedAddress = '';
            if (address) {
                const midIndex = Math.floor(address.length / 2);

                // Find the last space before the midpoint
                const lastSpaceIndex = address.lastIndexOf(' ', midIndex);

                // Split at the space, ensuring we don't break words
                formattedAddress += address.substring(0, lastSpaceIndex) + '<br>';
                formattedAddress += address.substring(lastSpaceIndex + 1);
            }
            return formattedAddress;
        };

        // Computed property to format the address
        const formattedAddress = computed(() => {
            return academy_details.value.academy_address ? formatAddress(academy_details.value.academy_address) : '';
        });

        // const logoSrc = computed(() => {
        //     return academy_details.value.academy_logo ? `/backend/images/academy/${academy_details.value.academy_logo}` : `/frontend/images/loregate.png`;
        // })

        const mapUrl = computed(() => {
            const address = academy_details.value.academy_address || "Hatirpool, Dhaka";
            return `https://www.google.com/maps/embed/v1/place?key=AIzaSyA1jvNq7HYUXGfndVFHNgtVZSELnzKwzPY&q=${encodeURIComponent(address)}`;
        });
        // Fetch data on component mount
        onMounted(() => {
            fetchData();
        });

        return {
            academy_details,
            formattedAddress,
            mapUrl,
            // logoSrc,
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
