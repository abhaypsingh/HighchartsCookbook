#!/usr/bin/env python2.7
from bottle import run, route, static_file, response
import json
import random

r = lambda: random.randint(0,100)

@route('/ajax/series')
def series():
    response.content_type = 'application/javascript'
    response.status = 200
    series = []
    for x in xrange(0,11):
        series.append({
            'y': r()
        })
        
    return json.dumps(series)

@route('/ajax/point')
def point():
    response.content_type = 'application/javascript'
    response.status = 200
    point = {
        'y': r()
    }
    return json.dumps(point)


# Static files
# e.g. HTML page and Javascript
@route('/')
def index():
    return static_file('index.html', root='.')
    
@route('/static/<filename:path>')
def index(filename):
    return static_file(filename, root='static')
    
run(host='localhost', port=5000)
