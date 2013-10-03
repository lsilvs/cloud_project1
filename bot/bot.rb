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

getmetroartistchart = "/2.0/?api_key=#{config['lastfm']['api_key']}&method=#{config['lastfm']['method']}&country=#{config['lastfm']['country']}&metro=#{config['lastfm']['metro']}"

@period_start = config['period']['start']
@period_end = config['period']['end']

@search_start = @period_start
@search_end = @search_start + (24*60*60) -1


Net::HTTP.start(config['lastfm']['host']) do |http|
  p "==== Geting #{getmetroartistchart} ===="

  while @search_start < @period_end
    resp = http.get(URI.encode(getmetroartistchart + "&start=#{@search_start}&end=#{@search_end}"))

    doc = REXML::Document.new(resp.body)
    @artists = doc.elements['lfm/topartists']

    @artists.elements.each('artist') do |a|
      if !(a.elements['name'].text).eql? config['artist']['name']
        next
      end
      # @array_artists << {:mbid => a.elements['mbid'].text, :name => a.elements['name'].text, :listeners => a.elements['listeners'].text}
      p a.elements['name'].text + " :: " + a.elements['listeners'].text

      line = "#{a.elements['mbid'].text},#{a.elements['name'].text},#{a.elements['listeners'].text}\n"

      open(config['artist']['name'],"a+") do |file|
        file.write(line)
      end

    end

    @search_start = @search_end + 1
    @search_end = @search_start + (24*60*60) -1

  end

end




