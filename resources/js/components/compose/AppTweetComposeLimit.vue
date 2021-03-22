<template>
    <div class="h-10 w-10 relative">
        <svg class="transform -rotate-90" viewBox="0 0 120 120">
            <circle cx="60" 
                    cy="60" 
                    fill="none" 
                    stroke-width="8" 
                    :r="radius" 
                    class="stroke-current text-gray-700"/>
            <circle cx="60" 
                    cy="60" 
                    fill="none" 
                    stroke-width="8" 
                    :r="radius" 
                    class="stroke-current text-blue-500" 
                    :stroke-dasharray="dash"
                    :stroke-dashoffset="offset"
                    />
        </svg>
    </div>
</template>
<script>
export default {
    data() {
        return {
            radius: 30
        }
    },
    computed: {
        dash() {
            return 2 * Math.PI * this.radius
        },
        offset() {
            let circ = this.dash
            let progress = 75 / 100
            return circ * (1 -progress)
        }
    }
}
</script>