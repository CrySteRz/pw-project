# generate command

vendor/bin/openapi --output C:\Users\Ionut\Desktop\pw-project\backend\util\openapi.yaml C:\Users\Ionut\Desktop\pw-project\backend\src
vendor/bin/openapi --output C:\Users\Ionut\Desktop\pw-project\backend\util\openapi.json C:\Users\Ionut\Desktop\pw-project\backend\src

# to run swagger, do this in cmd:

open-swagger-ui ./openapi.json --open
