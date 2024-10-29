## Decisions

The main decision was to find and provide a basic design for the project that is easily understandable and scalable as the project grows.

One improvement I would make in this project is to use a cache database to store the status and latency of the RPC providers, also uses the redis as queue to keep jobs. Since this information is updated and checked constantly, it would be good to bring performance while handling these requests.
The second improvement would be to handle better the api responses with a good pattern.
The main challenge during the development was to understand how async jobs works in Laravel, specially to understand how to make this "pings" in time without need to call it externaly.


