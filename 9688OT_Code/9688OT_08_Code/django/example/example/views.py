import json
from random import randint
from django.http import HttpResponse
from django.shortcuts import render_to_response

r = lambda: randint(0, 100)

def index(request):
    return render_to_response('index.html')

def point(request):
    result = {
        'y': r()
    }
    
    json_result = json.dumps(result)
    return HttpResponse(json_result, mimetype='application/json')
    
def series(request):
    results = []
    
    for i in xrange(1, 11):
        results.append({
            'y': r()
        })
        
    json_results = json.dumps(results)
    return HttpResponse(json_results, mimetype='application/json')
        
