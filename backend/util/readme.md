# generate command
vendor/bin/openapi --output C:\projects\my-projects\pw-project\backend\util\openapi.yaml C:\projects\my-projects\pw-project\backend\src
vendor/bin/openapi --output C:\projects\my-projects\pw-project\backend\util\openapi.json C:\projects\my-projects\pw-project\backend\src 


# to run swagger, do this in cmd:
open-swagger-ui ./openapi.json --open 