scanner:
	docker run \
		--rm \
		-e SONAR_HOST_URL="http://host.docker.internal:9090"  \
		-e SONAR_TOKEN="sqp_aca6d44eed76b812f984984c238101e92228f34a" \
		-v "./src:/usr/src" \
		sonarsource/sonar-scanner-cli

build:
	docker-compose up