/**
 * Fire toast from JS
 * 
 * Usage
 * =====
 * For the rare instances when we need to fire a toast from js
 * 
{# layout/toast/_toast_from_js.html.twig , included in base.html.twig #}
<div
    data-controller="toast-for-js"
    data-action="toast:show@window->toast-for-js#show"
>
    <template data-toast-for-js-target="template">
        {% include "layout/toast/_toast.html.twig" with {message: '' } %}
    </template>
</div>

{# in any stimulus controller #}
this.dispatch("show", {
        prefix: "toast",
        detail: {
            message: "Notifications activées avec succès !",
            type: "success|error",
        },
    });
 */
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["template"];

    show(event) {
        
        const { message, type = "success" } = event.detail;
        const toastEl = this.templateTarget.content.firstElementChild.cloneNode(true);

        // Element not attached to the DOM yet => stimulus targets not accessible => querySelector
        const messageEl = toastEl.querySelector('[data-toast-for-js-target="message"]');

        messageEl.textContent = message;

        if (type === "error") {
            toastEl.classList.remove("toast--success");
            toastEl.classList.add("toast--error");
        }

        this.element.appendChild(toastEl);
    }
}
