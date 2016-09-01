from django.conf.urls import patterns, include, url

from django.contrib import admin
admin.autodiscover()

# Add our views
import views

urlpatterns = patterns('',
    # Examples:
    # url(r'^$', 'example.views.home', name='home'),
    # url(r'^blog/', include('blog.urls')),

    url(r'^admin/', include(admin.site.urls)),
    
    # Add our URLs
    url(r'^/?$', views.index, name='index'),
    url(r'^ajax/point/?$', views.point, name='point'),
    url(r'^ajax/series/?$', views.series, name='series'),
)
