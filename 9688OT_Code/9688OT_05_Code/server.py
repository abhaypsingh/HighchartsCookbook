#!/usr/bin/env python2.7
import random
import json
from bottle import run, route, static_file, response

r = lambda: random.randint(0,255)

@route('/ajax/series')
def series():
    response.content_type = 'application/javascript'
    response.status = 200
    series = []
    for x in xrange(0,11):
        series.append({
            'y': r(), 
            'color': '#%02X%02X%02X' % (r(), r(), r()) 
        })
        
    return json.dumps(series)

# Static files
@route('/<path:path>')
def index(path):
    return static_file(path, root='my_project')
    
run(host='0.0.0.0', port=8000)
