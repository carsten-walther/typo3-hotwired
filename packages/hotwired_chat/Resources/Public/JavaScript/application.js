import { Application } from "../Libraries/stimulus.js"
window.Stimulus = Application.start()

import ResetFormController from "./controllers/reset_form_controller.js"
Stimulus.register("reset_form", ResetFormController)