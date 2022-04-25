                <v-card elevation="0" style="background:rgb(242 243 248);" >
                  <v-data-iterator
                    :items="aprobados"
                    :items-per-page.sync="itemsPerPage"
                    hide-default-footer
                  >

                    <template >
                      <v-row>
                        <v-spacer
                          v-for="aprobado in aprobados"
                          :key="aprobado.id"
                          cols="12"
                          sm="12"
                          md="12"
                
                          class="pa-4"
                        > 
                          <v-card class="my-2 ">
                            <v-card-title>
                              Consejo Nro:{{ aprobado.consejo_id }}
                              <v-btn color="primary" class="ml-auto" >N° Resolucion</v-btn>
                            </v-card-title>
                            
                            <v-divider></v-divider>

                            <v-list dense>
                              
                              <v-simple-table
                              :items-per-page="2">
                                  <template v-slot:default>
                                  <thead>
                                      <tr>
                                      <th class="text-left text-h6" >
                                          Nombre
                                      </th>
                                      <th class="text-left text-h6">
                                          Tramite
                                      </th>
                                      <th class="text-left text-h6">
                                          Fecha de inicio
                                      </th>
                                      <th class="text-left text-h6">
                                          Estado
                                      </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr
                                      v-for="(tramite,i) in aprobado.tramite"
                                      :key="i"
                                      >
                                      <td>{{ tramite.per_nom }}</td>
                                      <td>{{ tramite.tramite }}</td>
                                      <td>{{ tramite.fec_inicio }}</td>
                                      <td>{{ tramite.estado }}</td>
                                      </tr>
                                  </tbody>
                                  </template>
                              </v-simple-table>
                            </v-list>
                            <tfoot>
                            <td colspan="4" class="pl-4 #515252--text text-md-body-1 text-right">
                            <em> Fecha de Resolucion: {{ aprobado.consejo_fecha }}</em></td>
                            <td></td>
                            </tfoot>
                          </v-card>
                        </v-spacer>
                      </v-row>
                    </template>
                  </v-data-iterator>
                </v-card>
