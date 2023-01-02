"""
Django settings for racks project.

Generated by 'django-admin startproject' using Django 2.2.2.

For more information on this file, see
https://docs.djangoproject.com/en/2.2/topics/settings/

For the full list of settings and their values, see
https://docs.djangoproject.com/en/2.2/ref/settings/
"""

import os


# Build paths inside the project like this: os.path.join(BASE_DIR, ...)
BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

# Quick-start development settings - unsuitable for production
# See https://docs.djangoproject.com/en/2.2/howto/deployment/checklist/

# SECURITY WARNING: keep the secret key used in production secret!
SECRET_KEY = os.environ.get("SECRET_KEY")

# SECURITY WARNING: don't run with debug turned on in production!
DEBUG = bool(int(os.environ.get("DEBUG", default=1)))

ALLOWED_HOSTS = os.environ.get("DJANGO_ALLOWED_HOSTS").split(" ")

CORS_ALLOWED_ORIGINS = []

if DEBUG:
    CORS_ALLOWED_ORIGINS += [
        f"http://{os.environ.get('LOCALHOST')}:{os.environ.get('FRONTEND_PORT')}",
        f"http://{os.environ.get('LOCALHOST')}:{os.environ.get('BACKEND_PORT')}",
        f"http://{os.environ.get('FRONTEND_HOST')}:{os.environ.get('FRONTEND_PORT')}",
        f"http://{os.environ.get('BACKEND_HOST')}:{os.environ.get('BACKEND_PORT')}",
        f"http://{os.environ.get('FRONTEND_HOST')}:{os.environ.get('FRONTEND_TESTING_PORT')}",
        f"http://{os.environ.get('LOCALHOST')}:{os.environ.get('FRONTEND_TESTING_PORT')}",
        f"http://{os.environ.get('FRONTEND_TESTING_HOST')}:{os.environ.get('FRONTEND_TESTING_PORT')}",
    ]

# Application definition

INSTALLED_APPS = [
    'django.contrib.admin',
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'rest_framework',
    'rest_framework.authtoken',
    'djoser',
    'mongolog',
    'corsheaders',
    'drf_yasg',
    'django_extensions',
    'django_celery_beat',
    'django_celery_results',
    'silk',
    'mainapp',
]

REST_FRAMEWORK = {
    'DEFAULT_PERMISSION_CLASSES': (
        'rest_framework.permissions.IsAuthenticated',
    ),
    'DEFAULT_AUTHENTICATION_CLASSES': (
        'rest_framework.authentication.TokenAuthentication',
    )
}

MIDDLEWARE = [
    'django.middleware.security.SecurityMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',
    'corsheaders.middleware.CorsMiddleware',
    'django.middleware.common.CommonMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',
    'silk.middleware.SilkyMiddleware',
    'django.contrib.auth.middleware.AuthenticationMiddleware',
    'django.contrib.messages.middleware.MessageMiddleware',
    'django.middleware.clickjacking.XFrameOptionsMiddleware',
]

ROOT_URLCONF = 'racks.urls'

TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [os.path.join(BASE_DIR, 'templates')],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.debug',
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
            ],
        },
    },
]

WSGI_APPLICATION = 'racks.wsgi.application'

LOGGING = {
    'version': 1,
    'disable_existing_loggers': False,
    'handlers': {
        'mongolog': {
            'level': 'DEBUG',
            'class': 'mongolog.SimpleMongoLogHandler',
            'connection': f"{os.environ.get('LOGGING_DB_HOST')}://"
                          f"{os.environ.get('MONGO_INITDB_ROOT_USERNAME')}:"
                          f"{os.environ.get('MONGO_INITDB_ROOT_PASSWORD')}@"
                          f"{os.environ.get('LOGGING_DB_HOST')}:"
                          f"{os.environ.get('LOGGING_DB_PORT')}",
            'collection': 'mongolog'
        },
    },
    'loggers': {
        'mainapp': {
            'handlers': ['mongolog'],
            'level': 'DEBUG',
            'propagate': True
        },
    },
}

DATABASES = {
    'default': {
        'ENGINE': os.environ.get('SQL_ENGINE'),
        'NAME': os.environ.get('POSTGRES_DB'),
        'USER': os.environ.get('POSTGRES_USER'),
        'PASSWORD': os.environ.get('POSTGRES_PASSWORD'),
        'HOST': os.environ.get('DATABASE_HOST'),
        'PORT': os.environ.get('DATABASE_PORT'),
        'ATOMIC_REQUESTS': True
    }
}

SWAGGER_SETTINGS = {
    'USE_SESSION_AUTH': False,
    'SECURITY_DEFINITIONS': {
        'Bearer': {
            'type': 'apiKey',
            'name': 'Authorization',
            'in': 'header'
        }
    }
}

# Password validation
# https://docs.djangoproject.com/en/2.2/ref/settings/#auth-password-validators

AUTH_PASSWORD_VALIDATORS = [
    {
        'NAME': 'django.contrib.auth.password_validation.UserAttributeSimilarityValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.MinimumLengthValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.CommonPasswordValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.NumericPasswordValidator',
    },
]


# Internationalization
# https://docs.djangoproject.com/en/2.2/topics/i18n/

LANGUAGE_CODE = 'en-us'

TIME_ZONE = 'UTC'

USE_I18N = True

USE_L10N = True

USE_TZ = True


# Static files (CSS, JavaScript, Images)
# https://docs.djangoproject.com/en/2.2/howto/static-files/

STATIC_URL = '/static/'
STATICFILES_DIRS = [
    os.path.join(BASE_DIR, 'static'),
]
STATIC_ROOT = os.path.join(BASE_DIR, 'staticfiles')

START_PAGE_URL = f"http://{os.environ.get('LOCALHOST')}:{os.environ.get('BACKEND_PORT')}/"

CELERY_BROKER_URL = os.environ.get('CELERY_BROKER')
CELERY_RESULT_BACKEND = 'django-db'

CACHES = {
    'default': {
        'BACKEND': 'django.core.cache.backends.redis.RedisCache',
        'LOCATION': f"redis://{os.environ.get('LOCALHOST')}:{os.environ.get('MESSAGE_BROKER_PORT')}/1"
    }
}

CELERY_CACHE_BACKEND = 'default'
