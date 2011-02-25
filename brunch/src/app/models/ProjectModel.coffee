class ProjectModel extends Backbone.Model 

  EMPTY: ""

  initialize: ->
    if (!this.get("name"))
      this.set({"name": this.EMPTY})

  clear: ->
    this.destroy()
    this.view.remove()
