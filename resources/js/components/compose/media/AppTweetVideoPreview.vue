<template>
    <div class="mb-4">
        <video controls preload :src="generateVideoPreview(video)" class="rounded-lg"></video>
    </div>
</template>
<script>
export default {
    props: {
        video: {
            required: true,
            type: File
        }
    },
    methods: {
        generateVideoPreview(video) {
           return URL.createObjectURL(video)
        }
    }
}
</script>