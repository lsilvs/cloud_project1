require 'rubygems'
# require "bundler/setup"
require 'net/http'
require 'net/https'
require 'uri'
require 'rexml/document'
require 'yaml'
require 'json'
require 'fileutils'

config = YAML.load_file('bot.yml')

getmetroartistchart = "/2.0/?api_key=#{config['lastfm']['api_key']}&method=#{config['lastfm']['method']}&country=#{config['lastfm']['country']}&metro=#{config['lastfm']['metro']}&start=#{config['lastfm']['start']}&end=#{config['lastfm']['end']}" # &format=#{config['lastfm']['format']}

Net::HTTP.start(config['lastfm']['host']) do |http|
  p "==== Geting #{getmetroartistchart} ===="

  resp = http.get(URI.encode(getmetroartistchart))

  # p resp.body

  doc = REXML::Document.new(resp.body)
  @artists = doc.elements['lfm/topartists']
  # p @artists
end

  @artists.elements.each('artist') do |a|
    # @array_artists << {:mbid => a.elements['mbid'].text, :name => a.elements['name'].text, :listeners => a.elements['listeners'].text}
    p a.elements['name'].text

    line = "#{a.elements['mbid'].text}, #{a.elements['name'].text}, #{a.elements['listeners'].text}\n"

    open("test.txt","a") do |file|
      file.write(line)
    end
  end
