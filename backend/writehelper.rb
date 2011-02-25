require "sinatra"
require "json"

@@projects = []
@@texts = []

get '/' do
  'hello world'
end

get '/projects' do
  content_type :json
  {:models => @@projects }.to_json
end

post '/projects' do
  content_type :json
  project = JSON.parse(params[:model])
  @@projects << project
  project.to_json
end

get '/texts' do
  content_type :json
  {:models => @@texts}.to_json
end

post '/projects' do
  content_type :json
  text = JSON.parse(params[:model])
  @@texts << text
  text.to_json
end
