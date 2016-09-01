#!/usr/bin/env python2.7
from bottle import run, route, static_file, template, request, response
import json
import random

prev_point = {
    'y': 0
}

@route('/ajax/point', method='post')
def set_point():
    global prev_point
    prev_point = request.json

@route('/ajax/point', method='get')
def get_point():
    global prev_point
    response.content_type = 'application/javascript'
    response.status = 200
    point = {
        'y': int(prev_point.get('y'))
    }
    return json.dumps(point)

# Static files
# e.g. HTML page and Javascript
@route('/<path:path>')
def index(path):
    return static_file(path, root='.')
    
run(host='0.0.0.0', port=8000)
