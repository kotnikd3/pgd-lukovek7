<template>
    <div class="file has-name">
        <label class="file-label">
        <input @change="onChange" class="file-input" type="file" name="resume">
        <span class="file-cta">
            <span class="file-icon">
            <i class="fas fa-upload"></i>
            </span>
            <span class="file-label">
            Choose a file…
            </span>
        </span>
        <span class="file-name">
            Test
        </span>
        </label>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                newstype: "test"
            }
        },
        methods: {
            onChange() {
                console.log("Izbrana");
            }
        }
    }
</script>

<style>

</style>
