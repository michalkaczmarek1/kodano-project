# Kodano_Promotion module

## Run project

1. Install warden tool
   - https://docs.warden.dev/installing.html
2. commands
   - warden svc up
   - Go to project path and run command "warden env up". This command run project (containers for project).
   

## Install Application
```
bin/magento setup:install \
--backend-frontname=backend \
--amqp-host=rabbitmq \
--amqp-port=5672 \
--amqp-user=guest \
--amqp-password=guest \
--db-host=db \
--db-name=magento \
--db-user=magento \
--db-password=magento \
--search-engine=opensearch \
--opensearch-host=opensearch \
--opensearch-port=9200 \
--opensearch-index-prefix=magento2 \
--opensearch-enable-auth=0 \
--opensearch-timeout=15 \
--http-cache-hosts=varnish:80 \
--session-save=redis \
--session-save-redis-host=redis \
--session-save-redis-port=6379 \
--session-save-redis-db=2 \
--session-save-redis-max-concurrency=20 \
--cache-backend=redis \
--cache-backend-redis-server=redis \
--cache-backend-redis-db=0 \
--cache-backend-redis-port=6379 \
--page-cache=redis \
--page-cache-redis-server=redis \
--page-cache-redis-db=1 \
--page-cache-redis-port=6379

## Configure Application
bin/magento config:set --lock-env web/unsecure/base_url \
"https://${TRAEFIK_SUBDOMAIN}.${TRAEFIK_DOMAIN}/"

bin/magento config:set --lock-env web/secure/base_url \
"https://${TRAEFIK_SUBDOMAIN}.${TRAEFIK_DOMAIN}/"

bin/magento config:set --lock-env web/secure/offloader_header X-Forwarded-Proto

bin/magento config:set --lock-env web/secure/use_in_frontend 1
bin/magento config:set --lock-env web/secure/use_in_adminhtml 1
bin/magento config:set --lock-env web/seo/use_rewrites 1

bin/magento config:set --lock-env system/full_page_cache/caching_application 2
bin/magento config:set --lock-env system/full_page_cache/ttl 604800

bin/magento config:set --lock-env catalog/search/enable_eav_indexer 1

bin/magento config:set --lock-env dev/static/sign 0

bin/magento deploy:mode:set -s developer
bin/magento cache:disable block_html full_page

bin/magento indexer:reindex
bin/magento cache:flush

## Generate localadmin user
ADMIN_PASS="$(pwgen -n1 16)"
ADMIN_USER=localadmin

bin/magento admin:user:create \
--admin-password="${ADMIN_PASS}" \
--admin-user="${ADMIN_USER}" \
--admin-firstname="Local" \
--admin-lastname="Admin" \
--admin-email="${ADMIN_USER}@example.com"
printf "u: %s\np: %s\n" "${ADMIN_USER}" "${ADMIN_PASS}"

bin/magento mod:dis Magento_TwoFactorAuth 
```

## URL project

1. https://app.kodano.test
2. https://app.kodano.test/backend
   
## Unit test

1. Config

```
cp dev/tests/unit/phpunit.xml.dist dev/tests/unit/phpunit.xml
```

2. Run unit test

```
vendor/bin/phpunit -c dev/tests/unit/phpunit.xml app/code/Kodano/Promotion/Test/Unit

```

## API Documentation

1. https://app.kodano.test/rest/all/schema?services=all
    - return all endpoints
2. /V1/integration/admin/token - generate Bearer token to api for admin user
2. /V1/promotions - index promotions
3. /V1/promotion-groups - index promotions groups
4. /V1/promotion/save - save promotion
5. /V1/promotion-group/save - save promotion group
6. /V1/promotion/delete/:promotionId - delete promotion
7. /V1/promotion-group/delete/:promotionGroupId - delete promotion group


