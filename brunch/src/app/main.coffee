window.app = {}
app.controllers = {}
app.models = {}
app.views = {}
app.collections = {}

# app bootstrapping on document ready
$(document).ready ->
  # init controller
  app.controllers.main = new MainController()
  app.controllers.text = new TextController()
  app.controllers.project = new ProjectController()
  app.views.home = new HomeView()
  app.collections.projects = new ProjectCollection()

  Backbone.history.saveLocation("home") if '' == Backbone.history.getFragment()
  Backbone.history.start()
