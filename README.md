# Kodano_Promotion module

# Run project

1. Install warden
   - https://docs.warden.dev/installing.html
2. commands
   - warden svc up
   - Go to project path and run command "warden env up". This command run project (containers for project).
   
# URL project

1. https://app.kodano.test
2. https://app.kodano.test/backend
3. Create admin user
   - bin/magento admin:user:create
   

# API Documentation

1. https://app.kodano.test/rest/all/schema?services=all
    - return all endpoints
2. /V1/promotions - index promotions
3. /V1/promotion-groups - index promotions groups
4. /V1/promotion/save - save promotion
5. /V1/promotion-group/save - save promotion group
6. /V1/promotion/delete/:promotionId - delete promotion
7. /V1/promotion-group/delete/:promotionGroupId - delete promotion group
