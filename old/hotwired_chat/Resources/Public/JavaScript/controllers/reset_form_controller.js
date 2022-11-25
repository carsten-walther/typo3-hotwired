import { Controller } from "../../Libraries/stimulus.js"

export default class FilterController extends Controller {
    reset() {
        this.element.reset()
    }
}