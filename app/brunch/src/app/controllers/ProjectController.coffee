class ProjectController extends Backbone.Controller
  routes :
    "project": "index"
    "project/view/:pid": "view"

  constructor: ->
    super

  index: ->
    projectView = new ProjectListView()
    projectView.render()

  view = (pid) ->
    project = new ProjectModel()
    projectView = new ProjectView({model: project})
    project.render()
