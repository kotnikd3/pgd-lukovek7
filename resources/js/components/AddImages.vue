<template>
    <div class="margin-top-500">
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <div class="file is-primary" @mouseover="showTag = true" @mouseout="showTag = false">
                        <label class="file-label">
                            <input id="files" class="file-input" type="file" name="pictures[]" multiple @change="selected">
                            <span class="file-cta">
                                <span class="file-icon">
                                <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Dodaj slike ...
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="level-item">
                    <a v-if="images.length > 0" @click="unselect" class="button is-danger">
                        <span class="icon is-small"><i class="fas fa-times"></i></span>
                        <span>Izbriši dodane slike</span>
                    </a>
                </div>
                <div class="level-item">
                    <span v-if="showTag && images.length < 1" class="tag is-medium is-info">Da izberete več slik, morajo te na računalniku biti v isti mapi. Vsaka slika je lahko velika največ 8192 MB.</span>
                </div>
            </div>
        </div>
        

        <table v-if="images.length > 0" class="table is-striped is-hoverable">
            <thead>
                <tr>
                    <th><abbr title="ID">Ime</abbr></th>
                    <th><abbr title="Ime">Tip</abbr></th>
                    <th><abbr title="Priimek">Velikost</abbr></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="image in images" :key="image.name">
                    <td>{{ image.name }}</td>
                    <td>{{ image.type }}</td>
                    <td :class="{ 'has-background-danger' : sizeMb(image.size) > 8.192 }">{{ sizeMb(image.size) }} MB</td>
                </tr>
            </tbody>
        </table>

        <div class="columns is-multiline" v-if="images.length > 0">
            <figure v-for="(image, index) in images" :key="index" class="column is-half-tablet image is-128-128">
                <img :src="imageData[index]">
            </figure>
        </div>
        <br>
    </div>

</template>

<script>
export default {
    data() {
        return {
            images: [],
            imageData: [],
            showTag: false
        }
    },
    methods: {
        selected(event) {
            console.log("Slike izbrane!");

            this.images = [];
            this.imageData = [];
            // Reference to the DOM input element
            var inputFiles = event.target.files;

            // Ensure that you have a file before attempting to read it
            if (inputFiles && inputFiles.length > 0) {

                for (let i = 0; i < inputFiles.length; i++) {
                    // For listing the file names.
                    this.images.push(inputFiles[i]);

                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                        // Read image as base64 and set to imageData
                        this.imageData.push(e.target.result);
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(inputFiles[i]);
                }
            }
        },
        unselect() {
            console.log("Slike izbrisane!");
            document.getElementById('files').value = null;
            this.images = [];
            this.imageData = [];
        },
        sizeMb(size) {
            // From B to MB.
            return (parseInt(size) / 1000000).toFixed(3);
        }
    }
}
</script>
