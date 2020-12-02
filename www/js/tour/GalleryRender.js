"use strict";

class GalleryRender {
	 constructor(){
			this.el = document.createElement('img');
			this.container = document.getElementById('gallery__mini-bar');
			this.partner = document.getElementById('gallery').getAttribute('data-partner') + "/";
			this.program = document.getElementById('gallery').getAttribute('data-program') + "/";
	 }

	 init(name, alt, type){
	 	 this.el.setAttribute('src', "../../images/tours/" + this.partner + this.program + "micro/" + name);
	 	 this.el.setAttribute('data-full_image_url', "../../images/tours/" + this.partner + this.program + "user-size/" + name);
	 	 this.el.setAttribute('alt', alt);
	 	 this.el.setAttribute('data-image-type', type);
	 	 this.container.appendChild(this.el);
	 }
}