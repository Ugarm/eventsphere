import { RouterProvider } from "react-router-dom";
import { routes } from "./routers/Route";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { Provider } from "./stores/Provider";

function App() {
  const queryClient = new QueryClient();
  return (
    <QueryClientProvider client={queryClient}>
      <Provider>
        <RouterProvider router={routes} />
      </Provider>
    </QueryClientProvider>
  );
}

export default App;
