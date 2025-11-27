// For the rare instances when it's necessary to fire a toast from js
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["template", "message"];

    connect() {
        console.log('toast for js controller connected')
    }

    show(event) {

        console.log('show')
        
        const { message, type = "success" } = event.detail;

        const toastEl = this.templateTarget.content.firstElementChild.cloneNode(true);

        if (this.hasMessageTarget) {
            console.log('add message')
            this.messageTarget.textContent = message;
        }

        // Optional: tweak styles based on `type` ("success", "error", "info", ...)
        if (type === "error") {
            toastEl.classList.remove("text-gray-500", "bg-white");
            toastEl.classList.add("text-red-700", "bg-red-50");
            // you can also change icon, timerbar color, etc.
        }

        this.element.appendChild(toastEl);
    }
}
