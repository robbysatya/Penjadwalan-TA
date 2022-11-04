    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


      <div class="row">
        <div class="col-lg">
          <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= $this->session->flashdata('message');  ?>
          <!-- Modal Trigger -->
          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Sub
            Menu</a>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Sub Menu</th>
                <th scope="col">Menu</th>
                <th scope="col">Url</th>
                <th scope="col">Icon</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($subMenu as $sm) : ?>
              <tr>
                <th scope="row"><?= $no; ?></th>
                <td><?= $sm['title']; ?></td>
                <td><?= $sm['menu']; ?></td>
                <td><?= $sm['url']; ?></td>
                <td><?= $sm['icon']; ?></td>
                <td><?= $sm['is_active']; ?></td>
                <td style="text-align: center;">
                  <a href="#" data-toggle="modal" data-target="#editMenuModal<?= $sm['id']; ?>" class="btn btn-success"
                    data-popup="tooltip" data-placement="top" title="Edit Data">Edit</a>
                  <a href="#" class="btn btn-danger"
                    onclick="deleteConfirm('<?= site_url('menu/delete/' . $sm['id']); ?>')">Delete</a>
                </td>
              </tr>
              <?php $no++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Modal Fitur -->

    <!-- Modal Add Menu -->
    <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Edit Menu -->
    <?php $no = 0;
    foreach ($subMenu as $sm) : ?>
    <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="editSubMenuModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSubMenuModalLabel">Update Data Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/update') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="id" name="id" placeholder="Menu Name"
                  value="<?= $m['id'] ?>" hidden=true>
                <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name"
                  value="<?= $m['menu'] ?>">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal Delete Menu -->
    <div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteMenuModalLabel">Delete Confirm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure want to delete this menu?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="#" id="btn-delete" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Script Delete -->
    <script>
function deleteConfirm(url) {
  $('#btn-delete').attr('href', url);
  $('#deleteMenuModal').modal();
}
    </script>