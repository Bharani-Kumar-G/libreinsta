<template>
    <div class="p-3 bg-white shadow rounded-lg">
      <input type="file" name="image" accept="image/*" @change="setImage" />
  
      <!-- Image previewer -->
      <img :src="imageSrc" width="100" />
  
      <!-- Cropper container -->
      <div
        v-if="this.imageSrc"
        class="my-3 d-flex align-items-center justify-content-center mx-auto"
      >
        <vue-cropper
          class="mr-2 w-50"
          ref="cropper"
          :guides="true"
          :src="imageSrc"
        ></vue-cropper>
  
        <!-- Cropped image previewer -->
        <img class="ml-2 w-50 bg-light" :src="croppedImageSrc" />
      </div>
      <button v-if="this.imageSrc" @click="cropImage">Upload</button>
      <input type="hidden" v-bind:value="value" name="image">
      
    </div>
  </template>
  
  <script>
    import VueCropper from "vue-cropperjs"
    import "cropperjs/dist/cropper.css"
  
    export default {
      components: {
        VueCropper,
      },
      data: function () {
        return {
          imageSrc: "",
          croppedImageSrc: "",
          value: ""
        }
      },
      methods: {
        setImage: function (e) {
          const file = e.target.files[0]
          if (!file.type.includes("image/")) {
            alert("Please select an image file")
            return
          }
          if (typeof FileReader === "function") {
            const reader = new FileReader()
            reader.onload = event => {
              this.imageSrc = event.target.result
  
              // Rebuild cropperjs with the updated source
              this.$refs.cropper.replace(event.target.result)
            }
            reader.readAsDataURL(file)
          } else {
            alert("Sorry, FileReader API not supported")
          }
        },
        cropImage(e) {
          e.preventDefault();
          
          // Get image data for post processing, e.g. upload or setting image src
          this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL()
          this.$data.value = this.$refs.cropper.getCroppedCanvas().toDataURL()
        },
        
      },
    }
  </script>